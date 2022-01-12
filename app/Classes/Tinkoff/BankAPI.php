<?php namespace App\Classes\Tinkoff;

use App\Classes\BankContract\BankConnectContract;
use App\Classes\BankContract\BaseContracts;
use App\Classes\BankContract\CardLimitContract;
use App\Classes\BankContract\CloseCardContract;
use App\Classes\BankContract\StateCardContract;
use App\Classes\BankMain;
use App\Classes\Tinkoff\Traits\ConnectBanking;
use App\Classes\Tinkoff\Traits\OpenBanking;
use App\Models\Bank\Card;
use App\Models\Bank\Payment;
use Illuminate\Support\Carbon;

class BankAPI extends BankMain implements BankConnectContract, BaseContracts,
    CardLimitContract,
    StateCardContract,
    CloseCardContract
{
    use OpenBanking, ConnectBanking;


    public static function operationType($type, $result = Payment::REVENUE)
    {
        switch ($type) {
            case 1:
            case 9:
            case 16:
            case 17:
            case 18:
                $result = Payment::EXPENDITURE;
                break;
            case 2:
            case 3:
            case 4:
            case 6:
            case 7:
            case 8:
            case 12:
                $result = Payment::REVENUE;
                break;
        }
        return $result;
    }

    public function refreshCards()
    {
//        dd($this->getCards()->collect('cards'));
        $count = 0;
        foreach ($this->getCards()->collect('cards') as $card) {
            if ($count > 100) continue;
            $cards[] = $this->getCardInfo($card['ucid'])->json();
            $count++;
            dd($cards);
        }
//        dd($cards);
    }

    public function getAccountsData(&$data)
    {
        $i = 0;
        $accountsList = collect($this->getAccountsList()->object());
        foreach ($this->bank->invoices()->get() as $account) {
            $accountApi = $accountsList->where('accountNumber', $account->account_id)->first();
            if ($accountApi) {
                $data[$i]['id'] = $account->id;
                $data[$i]['account_id'] = $account->account_id;
                $data[$i]['bank_token_id'] = $account->bank_token_id;
                $data[$i]['company_id'] = $account->company_id;
                $data[$i]['currency'] = $this->currency($accountApi->currency);
                $data[$i]['avail'] = $accountApi->balance->otb;
                $data[$i]['current'] = $accountApi->balance->authorized;
            }

            $i++;
        }

        return $data;
    }

    private function currency($code)
    {
        switch ($code) {
            case 643:
                $result = 'RUB';
                break;
            case 826:
                $result = 'GBP';
                break;
            case 840:
                $result = 'USD';
                break;
            case 978:
                $result = 'EUR';
                break;
        }
        return $result;
    }

    public function getStatementsData(array &$data): array
    {
        return $data;
    }

    public function getPaymentsData(array &$data): array
    {
        $countCard = 0;
        foreach ($this->bank->invoices()->get() as $account) {
            $statement = $this
                ->initStatement($account->account_id, now()->subMonth()->format('Y-m-d'), now()->format('Y-m-d'))
                ->json();
            foreach ($statement['operation'] as $payment) {
                $cardId = 0;
                preg_match("/номер (\d{4})...(\d{4})/", $payment['paymentPurpose'] ?? '', $cards);
                if (isset($cards[1], $cards[2])) {
                    $card = Card::query()
                        ->where('head', $cards[1])
                        ->where('tail', $cards[2])
                        ->where('account_code', $account->account_id)
                        ->first(['id']);
                    $cardId = $card ? $card->id : null;

                    if (Payment::where('transaction_id', $payment['operationId'])->where('card_id', $cardId)->exists())
                        continue;

                    if ($cardId) $countCard++;
                }
                $payment = (object)$payment;

                $type = Payment::EXPENDITURE;
                if ($payment->recipientAccount == $account->account_id) {
                    $type = Payment::REVENUE;
                }

                $data[] = [
                    'transaction_id' => $payment->operationId,
                    'description' => $payment->paymentPurpose,
                    'account_id' => $account->account_id ?? $payment->payerAccount,
                    'card_id' => $cardId ?? '',
                    'type' => $type,
                    'status' => Payment::BOOKED,
                    'amount' => $payment->amount,
                    'currency' => $account->currency ?? 'RUB',
                    'operationAt' => Carbon::createFromFormat('Y-m-d H', $payment->date . ' 00'),
                ];
            }
        }
        $data['countCard'] = $countCard;

        return $data;
    }
}
