<?php namespace App\Classes\Tinkoff;


use App\Classes\Tinkoff\Traits\ConnectBanking;
use App\Classes\Tinkoff\Traits\OpenBanking;
use App\Models\Bank\Account;
use App\Models\Bank\BankToken;

class BankAPI
{
    use OpenBanking, ConnectBanking;

    private $bank;

    public function __construct($bank)
    {
        $this->bank = $bank;
    }

    public static function make(): \App\Classes\TochkaBank\BankAPI
    {
        return new BankAPI(BankToken::make());
    }

    public function getAccountsData(&$data)
    {
        $i = 0;
        $accountsList = collect($this->getAccountsList());
        foreach (Account::get() as $account) {
            $accountApi = $accountsList->where('accountNumber', $account->account_id)->first();
            if ($accountApi) {
                $data[$i]['id'] = $account->id;
                $data[$i]['account_id'] = $account->account_id;
                $data[$i]['company_id'] = $account->company_id;
                $data[$i]['currency'] = $accountApi->currency == 643 ? 'RUB' : 'USD';
                $data[$i]['avail'] = $accountApi->balance->authorized;
                $data[$i]['current'] = $accountApi->balance->otb;
            }

            $i++;
        }

        return $data;
    }

}
