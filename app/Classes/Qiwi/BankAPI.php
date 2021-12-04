<?php namespace App\Classes\Qiwi;


use App\Classes\BankMain;
use App\Classes\Qiwi\Traits\OpenBanking;
use App\Models\Bank\Account;
use App\Models\Bank\Card;
use App\Models\Bank\Payment;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Support\Str;
use Smalot\PdfParser\Parser;

class BankAPI extends BankMain
{
    use OpenBanking;

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
            $dateStart = $dateEnd->clone()->subMonth();
            return $data = $this->getStatement($account->account_id, null, $dateStart, $dateEnd)
                ->collect('data')
                ->map(function ($payment) use($account)
                {
                    $cardId = null;
                    $amount = isset($payment['total']) ? $payment['total']['amount'] : 0;
                    $description = $payment['source']['description'] ?? $payment['source']['keys'];

                    preg_match('/([*]{8}\d{4})|(\d{4}[*]{8})/u', $payment['account'], $cardNumber);
                    $cardNumberSplit = Card::getNumberSplit($cardNumber[1]);

                    // настраиваем поиск карт
                    $queryCardAccount = $account->cards();
                    $statusSearchCard = false;
                    if($cardNumberSplit[0] !== '****') {
                        $queryCardAccount->where('head', $cardNumberSplit[0]);
                        $statusSearchCard = true;
                    }
                    if ($cardNumberSplit[2] !== '****') {
                        $queryCardAccount->where('tail', $cardNumberSplit[2]);
                        $statusSearchCard = true;
                    }

                    // если поиск удался и транзакция прошла по карте, то
                    if ($statusSearchCard) {
                        $cardAccountModel = $queryCardAccount->get(['id', 'ucid'])
                            ->map(function (Card $card) use($payment, $account, $amount) {
                                $dateEnd = Carbon::createFromFormat(DateTimeInterface::W3C ,$payment['date'])
                                    ->addMinute()->setSecond(0);
                                $dateStart = $dateEnd->clone()->subMinute();

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
                        'account_id' => $account,
                        'card_id' => $cardId,
                        'type' => $this->isRevenue($payment['type']) ? Payment::REVENUE : Payment::EXPENDITURE,
                        'status' => $this->getStatus($payment['status']),
                        'amount' => $amount,
                        'currency' => $this->getCurrency($payment['total']['currency']) ?? 'RUB',
                        'operationAt' => Carbon::createFromFormat(DateTimeInterface::W3C ,$payment['date']),
                    ];
                });
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
        $cards = $this->getCards()->collect();

        $cards->each(function ($card) {
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
