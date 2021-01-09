<?php namespace App\Classes\TochkaBank;

use App\Classes\TochkaBank\Traits\ConnectBanking;
use App\Classes\TochkaBank\Traits\OpenBanking;
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
        return new BankAPI(BankToken::all()->first());
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
