<?php

namespace App\Classes\BankContract;

use Carbon\Carbon;
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
    public function getStatementsList(): Response;

    /**
     * Метод получения конкретной выписки
     *
     * @param string $accountId
     * @param string|null $statementId
     * @param null $dateStart
     * @param null $dateEnd
     * @return Response
     */
    public function getStatement(string $accountId, string $statementId = null,  $dateStart = null, $dateEnd = null): Response;

    /**
     * Метод создания выписки по конкретному счету
     * @param null $statementId
     * @return Response
     * @var string $accountId
     */
    public function initStatement(string $accountId, $startDateTime, $endDateTime, $statementId = null): Response;

}
