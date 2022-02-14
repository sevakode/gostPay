<?php namespace App\Classes\Qiwi;

use App\Classes\BankContract\BaseContracts;
use App\Classes\BankContract\BlockCardContract;
use App\Classes\BankContract\GenerateCardsContract;
use App\Classes\BankContract\OpenCardContract;
use App\Classes\BankMain;
use App\Classes\Qiwi\Traits\OpenBanking;
use App\Models\Bank\Account;
use App\Models\Bank\Card;
use App\Models\Bank\Payment;
use App\Notifications\DataNotification;
use Carbon\Carbon;
use DateTimeInterface;
use ErrorException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;

class BankAPI extends BankMain implements
    BaseContracts,
    GenerateCardsContract,
    OpenCardContract,
    BlockCardContract
{
    use OpenBanking;

    public function createCards(Account $account, int $count = 1): Collection
    {
        /**
         * @throws RequestException
         */
        $onError = function (Response $response) {
            return $response->throw();
        };

        $data = [];

        for ($i=1; $i<=$count; $i++) {
            try {
                $createOrder = $this
                    ->createOrderCard($account->account_id)
                    ->onError($onError)->object();
                $submitOrder =  $this
                    ->submitOrderCard($account->account_id, $createOrder->id)
                    ->onError($onError)
                    ->json();
                $payOrder = $this
                    ->payOrderCard($account->account_id, $createOrder->id)
                    ->onError($onError)
                    ->json();
                $transactionCreatedCard = $this
                    ->getPaymentStatus($payOrder['transaction']['id'])
                    ->onError($onError)
                    ->object();
                $cards = $this // получаем список всех карт на счету
                    ->getCards()
                    ->onError($onError)
                    ->collect();


//                 выводим дату создания транзакции в объект Carbon
                $transactionDate = Carbon::createFromFormat(DateTimeInterface::W3C, $transactionCreatedCard->date);
//                 получаем свободную карту
                $cardAvailable = $cards->filter(function ($item) use ($transactionDate) {
                    $activatedCardDate = Carbon::createFromFormat(DateTimeInterface::W3C, $item['qvx']['activated']);

                    $where = $activatedCardDate->gt($transactionDate);
                    return $where;
                })->sortByDesc(function ($item) use ($transactionDate) {
                    $activatedCardDate = Carbon::createFromFormat(DateTimeInterface::W3C, $item['qvx']['activated']);
                    return $activatedCardDate->timestamp;
                })->first(function ($item) use ($account, &$cardRequisite) {
                    $cardRequisite = $this->getCardInfo($item['qvx']['id'])->object();
                    $queryCards = Card::query()->where('account_code', $account->account_id);
                    $queryCards = $this->searchCard($queryCards, $cardRequisite->pan);

                    if ($queryCards) {
                        $card = $queryCards->get()->filter(function (Card $card) use($cardRequisite) {
                            return $card->numberFull == $cardRequisite->pan;
                        });
                    } else {
                        throw new ErrorException('Произошла неизвестная ошибка на сервере');
                    }

                    return $card->isEmpty();
                });

                $data['success'][] = collect([
                    'cardInfo' => $cardAvailable,
                    'requisite' => $cardRequisite
                ]);
            }
            catch (\Exception $e) {
                $response = $e->response->collect();
                $message = $response->get('message', 'Произошла неизвестная ошибка');
                $code = $response->get('code', 'server-error');
                DataNotification::sendErrors([$message]);
                $data['error'][] = collect([
                    'message' => $message,
                    'code' => $code,
                    'error' => $e,
                ]);
            }
        }

        return collect($data);
    }

    public function getAccountsData(&$data)
    {
        $i = 0;
        foreach ($this->bank->invoices()->get() as $account) {
            $data[$i] = [
                'id' => $account->id,
                'account_id' => $account->account_id,
                'bank_token_id' => $account->bank_token_id,
                'company_id' => $account->company_id,
            ];
            $accountResponse = $this->bank->api()->getBalanceInfo($account->account_id);
            $balanceInfo = (object) $accountResponse
                ->collect('accounts')
                ->where('hasBalance', true)
                ->first();

            $data[$i]['avail'] = $balanceInfo->balance['amount'];
            $data[$i]['current'] = $balanceInfo->balance['amount'];

            switch ($balanceInfo->balance['currency']) {
                case 643:
                    $data[$i]['currency'] = 'RUB';
            }

            $i++;
        }

        return $data;
    }

    public function getPaymentsData(array &$data): array
    {
        return $this->bank->invoices()->get()->map(function (Account $account) use(&$data) {
            $dateEnd = Carbon::now();
            $dateStart = new Carbon();
            $dateStart->year = 21;
            $dateStart->month = 12;
            $dateStart->day = 1;

            return $data = $this->getStatement($account->account_id, null, $dateStart, $dateEnd)
                ->collect('data')
                ->map(function ($payment) use($account)
                {
                    $cardId = null;
                    $amount = isset($payment['total']) ? $payment['total']['amount'] : 0;
                    $description = $payment['source']['description'] ?? $payment['source']['keys'];

                    preg_match('/([*]{8}\d{4})|(\d{4}[*]{8})/u', $payment['account'], $cardNumber);

                    // настраиваем поиск карт
                    $queryCardAccount = $account->cards();
                    $queryCardAccount = $this->searchCard($queryCardAccount, $cardNumber[1]);

                    // если поиск удался и транзакция прошла по карте, то
                    if ($queryCardAccount) {
                        $cardAccountModel = $queryCardAccount->get(['id', 'ucid'])
                            ->map(function (Card $card) use($payment, $account, $amount) {
                                $dateEnd = Carbon::createFromFormat(DateTimeInterface::W3C ,$payment['date'])
                                    ->addMinute()->setSecond(0);
                                $dateStart = $dateEnd->clone()->subMinute();

                                if (is_null($card->ucid)) $this->refreshCards();

                                $response = $this
                                    ->initStatement($account->account_id, $dateStart, $dateEnd, $card->ucid);

                                $parserPDF = new Parser();
                                $file = $parserPDF->parseContent($response->body());

                                $type = $this->isRevenue($payment['type']) ? '' : '-';

                                $isPaymentCard = preg_match("/$type$amount/u", $file->getText());
                                if ($isPaymentCard) {
                                    return $card;
                                }

                                return null;
                            })
                            ->filter()
                            ->first();

                        if ($cardAccountModel) {
                            $cardId = $cardAccountModel->id;
                        }
                        // если карта была найдена, но оплаты такой нет, то пропускаем ее
                        else {
                            return null;
                        }
                    }

                    return [
                        'transaction_id' => $payment['txnId'],
                        'description' => $description,
                        'account_id' => $account->account_id,
                        'card_id' => $cardId,
                        'type' => $this->isRevenue($payment['type']) ? Payment::REVENUE : Payment::EXPENDITURE,
                        'status' => $this->getStatus($payment['status']),
                        'amount' => $amount,
                        'currency' => $this->getCurrency($payment['total']['currency']) ?? 'RUB',
                        'operationAt' => Carbon::createFromFormat(DateTimeInterface::W3C ,$payment['date']),
                    ];
                })->filter();
        })->filter()->toArray();
    }

    public function getStatementsData(array &$data): array
    {
        return [];
    }

    private function isRevenue($type): bool
    {
        return $type == 'IN';
    }

    public function refreshCards()
    {
        $this->getCards()->collect()->each(function ($card) {
            $qvx = (object) $card['qvx'];
            $info = (object) $card['info'];
            $requisites = $this->getCardInfo($qvx->id)->object();

            $number = Card::getNumberSplit($requisites->pan);
            $queryCard = Card::query()->where('head', $number[0])->where('tail', $number[3]);

            $queryCard->get(['id', 'number'])
                // ищем совпадение
                ->map(function (Card $card) use($requisites) {
                    if ($card->numberFull == $requisites->pan)
                        return $card->refresh();
                    return null;
                })
                ->filter()
                // обновляем реквизиты карты
                ->each(function (Card $card) use($qvx, $info) {
                    $card->ucid = $qvx->id;
                    $card->expiredAt = Carbon::createFromFormat(DateTimeInterface::W3C ,$qvx->cardExpire);
                    $card->state = Str::lower($qvx->status) == 'active' ? Str::lower($qvx->status) : 'close';
                    $card->card_description = $info->name;
                    $card->card_type = $info->type;
                    $card->bank_code = $info->alias;

                    $card->save();
                });
        });
    }
//
//    public function getCardState(string $correlationId): Response
//    {
//
//    }
    private function isCardPdfPayment()
    {
    }

    public function searchCard($queryCardAccount, string $cardNumber)
    {
        $cardNumberSplit = Card::getNumberSplit($cardNumber);
        $statusSearchCard = false;
        if($cardNumberSplit[0] !== '****') {
            $queryCardAccount->where('head', $cardNumberSplit[0]);
            $statusSearchCard = true;
        }
        if ($cardNumberSplit[2] !== '****') {
            $queryCardAccount->where('tail', $cardNumberSplit[2]);
            $statusSearchCard = true;
        }

        return $statusSearchCard ? $queryCardAccount : false;
    }

    private function getStatus(string $status)
    {
        switch ($status) {
            case 'WAITING' :
                return Payment::PENDING;
            case 'SUCCESS' :
                return Payment::BOOKED;
            default:
                return Payment::CANCELED;
        }
    }

    private function getCurrency(int $currency): string
    {
        switch ($currency) {
            case 643 :
                return 'RUB';
            default:
                return 'USD';
        }
    }
}
