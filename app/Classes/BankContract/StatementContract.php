<?php

namespace App\Classes;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

/**
 * ----------------------------------------------------------------------------------------------------------------
 * Работа с выписками
 * ----------------------------------------------------------------------------------------------------------------
 */
interface StatementContract
{
    /**
     * Метод получения списка доступных выписок
     *
     * @return PromiseInterface|Response
     */
    public function getStatementsList(): PromiseInterface|Response;

    /**
     * Метод получения конкретной выписки
     *
     * @param string $accountId
     * @param string|null $statementId
     * @return PromiseInterface|Response
     */
    public function getStatement(string $accountId, string $statementId = null): PromiseInterface|Response;

    /**
     * Метод создания выписки по конкретному счету
     * @return PromiseInterface|Response
     * @var string $accountId
     * @var string $startDateTime
     * @var string $endDateTime
     */
    public function initStatement(string $accountId, string $startDateTime, string $endDateTime): PromiseInterface|Response;

}
