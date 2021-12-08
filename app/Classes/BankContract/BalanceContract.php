<?php

namespace App\Classes\BankContract;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
/**
 * ----------------------------------------------------------------------------------------------------------------
 * Работа с балансами счетов
 * ----------------------------------------------------------------------------------------------------------------
 */
interface BalanceContract
{
    /**
     * Метод получения баланса по нескольким счетам
     *
     * @return PromiseInterface|Response
     */
    public function getBalancesList(): Response;

    /**
     * Метод получения информации о балансе конкретного счета
     *
     * @param string $accountId
     * @return object
     */
    public function getBalanceInfo(string $accountId): Response;

}
