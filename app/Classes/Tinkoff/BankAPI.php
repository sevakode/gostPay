<?php namespace App\Classes\Tinkoff;


use App\Classes\BankMain;
use App\Classes\Tinkoff\Traits\ConnectBanking;
use App\Classes\Tinkoff\Traits\OpenBanking;
use App\Models\Bank\Account;

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

    public function getPaymentsData(array &$data): array
    {
        foreach ($this->bank->invoices()->get() as $account) {
            $statement = $this->initStatement($account->account_id, '2020-08-01', now()->format('Y-m-d'));
            dd($this->getAccountsList());
            dd($statement);
            foreach ($statement->operation as $payment) {
                $data[] = [
                    'transaction_id' => $payment->operationId,
                    'description' => $payment->description,
                    'account_id' => $statement->Data->Statement[0]->accountId,
                    'card_id' => $cardId ?? '',
                    'type' => $payment->creditDebitIndicator == 'Credit' ? self::REVENUE : self::EXPENDITURE,
                    'status' => $payment->status,
                    'amount' => $payment->Amount->amount,
                    'currency' => $payment->Amount->currency,
                    'operationAt' => Carbon::createFromFormat('d#m#Y H', $data[1] . ' 00'),
                ];
            }
        }

        return $data;
    }

}
