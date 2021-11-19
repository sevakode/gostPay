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
    public function getAccountsList($accounts = []): Response;

    /**
     * Метод получения информации по конкретному счёту
     *
     * @param string|null $accountId
     * @return Response
     */
    public function getAccountInfo(string $accountId = null): Response;


}
