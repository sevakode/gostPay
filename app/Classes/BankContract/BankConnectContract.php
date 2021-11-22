<?php

namespace App\Classes\BankContract;

interface BankConnectContract
{
    public function connectTokenCredentials(): mixed;
    public function connectTokenRefresh(): \Illuminate\Http\Client\Response;
}
