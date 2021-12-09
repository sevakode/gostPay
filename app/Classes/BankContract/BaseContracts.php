<?php

namespace App\Classes\BankContract;

interface BaseContracts extends
    AccountContract,
    BalanceContract,
    CardContract,
    ClientContract,
//    PaymentContract,
    StatementContract
{

}
