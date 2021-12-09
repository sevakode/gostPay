<?php

namespace App\Classes\BankContract;
use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

/**
 * ----------------------------------------------------------------------------------------------------------------
 * Работа с картами
 * ----------------------------------------------------------------------------------------------------------------
 */
interface CardContract
{
    /**
     * Метод получения списка карт
     *
     * @param null $accountNumber
     * @return PromiseInterface|Response
     */
    public function getCards($accountNumber = null): Response;

    /**
     * Метод получения списка карт
     *
     * @param int $ucid
     * @return PromiseInterface|Response
     */
    public function getCardInfo(int $ucid): Response;

    /**
     * Метод получения состояния карты
     *
     * @return PromiseInterface|Response
     * @var string $cardCode
     */
//    public function getCardState(string $correlationId): Response;

    /**
     * Метод смены состояния карты
     *
     * @param string $cardCode
     * @param string $newState
     * @return PromiseInterface|Response
     */
//    public function editCardState(string $cardCode, string $newState = 'lockedCard'): Response;
}
