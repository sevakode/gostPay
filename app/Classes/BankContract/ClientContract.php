<?php

namespace App\Classes\BankContract;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

/**
 * ----------------------------------------------------------------------------------------------------------------
 * Работа с клиентами
 * ----------------------------------------------------------------------------------------------------------------
 */
interface ClientContract
{

    /**
     * Метод получения списка доступных клиентов
     *
     * @return PromiseInterface|Response
     */
    public function getCustomersList(): Response;

    /**
     * Метод получения списка доступных клиентов
     * @var string $customerCode
     * @return PromiseInterface|Response
     */
    public function getCustomerInfo(string $customerCode): Response;
}
