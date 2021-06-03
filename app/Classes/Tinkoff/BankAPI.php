<?php namespace App\Classes\Tinkoff;


use App\Classes\BankMain;
use App\Classes\Tinkoff\Traits\ConnectBanking;
use App\Classes\Tinkoff\Traits\OpenBanking;
use App\Models\Bank\Account;
use App\Models\Bank\Card;
use App\Models\Bank\Payment;
use Illuminate\Support\Carbon;

class BankAPI extends BankMain
{
    use OpenBanking, ConnectBanking;

    public function getAccountsData(&$data)
    {
        $i = 0;
        $accountsList = collect($this->getAccountsList());
        foreach ($this->bank->invoices()->get() as $account) {
            $accountApi = $accountsList->where('accountNumber', $account->account_id)->first();
            if ($accountApi) {
                $data[$i]['id'] = $account->id;
                $data[$i]['account_id'] = $account->account_id;
                $data[$i]['bank_token_id'] = $account->bank_token_id;
                $data[$i]['company_id'] = $account->company_id;
                $data[$i]['currency'] = $accountApi->currency == 643 ? 'RUB' : 'USD';
                $data[$i]['avail'] = $accountApi->balance->otb;
                $data[$i]['current'] = $accountApi->balance->authorized;
            }

            $i++;
        }

        return $data;
    }

    public function getStatementsData(array &$data): array
    {
        return $data;
    }

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

    public function getPaymentsData(array &$data): array
    {
        $countCard = 0;
        foreach ($this->bank->invoices()->get() as $account) {
            $statement = $this->initStatement($account->account_id, '2020-01-01', now()->format('Y-m-d'));

            foreach ($statement->operation as $payment) {
                preg_match("/номер (\d{4})...(\d{4})/", $payment['paymentPurpose'] ?? '', $cards);
                if(isset($cards[1], $cards[2])) {
                    $cardId = Card::where('head', $cards[1])->where('tail', $cards[2])->first() ?
                        Card::where('head', $cards[1])->where('tail', $cards[2])->first()->id :
                        null;

                    if (Payment::where('transaction_id', $payment['operationId'])->where('card_id', $cardId)->exists())
                        continue;

                    if($cardId) $countCard++;
                }
                $payment = (object) $payment;
                $data[] = [
                    'transaction_id' => $payment->operationId,
                    'description' => $payment->paymentPurpose,
                    'account_id' => $account->account_id ?? $payment->payerAccount,
                    'card_id' => $cardId ?? '',
                    'type' => self::operationType($payment->operationType),
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
