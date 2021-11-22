<?php

namespace App\Classes\BankContract;

interface BankConnectContract
{
    public function connectTokenCredentials(): mixed;
    public function connectTokenRefresh(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response;
}
