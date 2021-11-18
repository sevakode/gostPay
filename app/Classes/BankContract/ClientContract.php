<?php

namespace App\Classes;

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
    public function getCustomersList(): PromiseInterface|Response;

    /**
     * Метод получения списка доступных клиентов
     * @var string $customerCode
     * @return PromiseInterface|Response
     */
    public function getCustomerInfo(string $customerCode): PromiseInterface|Response;
}
