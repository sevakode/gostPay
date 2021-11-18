<?php

namespace App\Classes;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
/**
 * ----------------------------------------------------------------------------------------------------------------
 * Работа со счетами
 * ----------------------------------------------------------------------------------------------------------------
 */
interface AccountContract
{
    /**
     * Метод получения списка доступных счетов
     */
    public function getAccountsList(): PromiseInterface|Response;

    /**
     * Метод получения информации по конкретному счёту
     *
     * @param string $accountId
     * @return object
     */
//    public function getAccountInfo(string $accountId): object


}
