<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class QiwiBankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $token = new \App\Models\Bank\BankToken();

        $token->url = 'https://edge.qiwi.com';
        $token->rsUrl = 'https://edge.qiwi.com';
        $token->apiVersion = 'v2';
        $token->bankId = 'a';
        $token->bankSecret = 'a';
        $token->key = Str::random('32');
        $token->authCode = 9221032748;
        $token->accessToken = 'c6a246fd877630b45789b797c10590f2';
        $token->refreshToken = null;

        if (!$token::query()->where('accessToken', $token->accessToken)->exists()) {

            $token->save();
        }
    }
}
