<?php

namespace App\Classes;

interface BankConnectContract
{
    public function connectTokenCredentials(): mixed;
    public function connectTokenRefresh(): \GuzzleHttp\Promise\PromiseInterface|\Illuminate\Http\Client\Response;
}
