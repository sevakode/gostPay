<?php

namespace App\Classes;

interface BankConnectContract
{
    public function connectTokenCredentials(): mixed;
    public function connectTokenRefresh(): \Illuminate\Http\Client\Response;
}
