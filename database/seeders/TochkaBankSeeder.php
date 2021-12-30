<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TochkaBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $token = new \App\Models\Bank\BankToken();
        if (!$token::query()->where('accessToken', 'VyzPwrEGseq3wT2G1XHwkq9B4LAs8NDl')->exists()) {
            $token->url = 'https://enter.tochka.com';
            $token->rsUrl = 'https://enter.tochka.com/uapi';
            $token->key = Str::random('32');
            $token->apiVersion = 'v1.0';
            $token->bankId = '1X9kWVAQqqM5FXDXucyr8DgyDTfCDQVc';
            $token->bankSecret = 'RJB1Wbwtb9T1GQIjI3FWDUk0Xf6NVe9w';

            $token->accessToken = 'VyzPwrEGseq3wT2G1XHwkq9B4LAs8NDl';
            $token->refreshToken = 'Sd65IVlX2U7s77t46lIqCp2CDYbfH4SN';

            $token->save();
        }
    }
}
