<?php

namespace App\Classes\BankContract;

interface BankConnectContract
{
    public function connectTokenCredentials();
    public function connectTokenRefresh(): \Illuminate\Http\Client\Response;
}
