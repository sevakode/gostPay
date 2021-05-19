<?php namespace App\Classes\TochkaBank;

use App\Classes\TochkaBank\Traits\ConnectBanking;
use App\Classes\TochkaBank\Traits\OpenBanking;
use App\Models\Bank\Account;
use App\Models\Bank\BankToken;
use Illuminate\Support\Facades\Log;

class BankAPI
{
    use OpenBanking, ConnectBanking;

    private $bank;

    public function __construct($bank)
    {
        $this->bank = $bank;
    }

    public static function make(): BankAPI
    {
        return new BankAPI(BankToken::make());
    }

    public function getAccountsData(&$data)
    {
        $i = 0;
        foreach (Account::get() as $account) {
            $data[$i]['id'] = $account->id;
            $data[$i]['account_id'] = $account->account_id;
            $data[$i]['company_id'] = $account->company_id;

            $accountId = "$account->account_id/044525999";
            try {
                $balanceTypeList = $this->getBalanceInfo($accountId)->Data->Balance;
            }
            catch (\Exception $e) {
                if(!isset($this->getBalanceInfo($accountId)->message))
                    dd($this->getBalanceInfo($accountId));
                continue;
            }

            foreach ($balanceTypeList as $balance) {
                $data[$i]['currency'] = $balance->Amount->currency;

                if($balance->type == 'OpeningAvailable') {
                    $data[$i]['avail'] = $balance->Amount->amount;
                }
                else if ($balance->type == 'ClosingAvailable') {
                    $data[$i]['current'] = $balance->Amount->amount;
                }
            }

            $i++;
        }

        return $data;
    }

	protected function send($uri, $headers = null, $body = null)
    {
        $arHeaders = $headers;
        if ($headers) {
            array_walk($headers, function (&$item, $key) { $item = "{$key}: {$item}"; });
        }
        if ($body) {
            if($arHeaders['Content-Type'] == 'application/x-www-form-urlencoded')
                $body = http_build_query($body);

            else $body = json_encode($body);
        }
        Log::info($uri);
        Log::info(print_r($headers, true));
        Log::info(print_r($body, true));
        $ch = curl_init();
//        dd($ch);
        curl_setopt($ch, CURLOPT_URL, $uri);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        dd($ch);
        if ($body) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $result = curl_exec($ch);
        curl_close($ch);
        Log::info($result);
        return json_decode($result, true);
    }
}
