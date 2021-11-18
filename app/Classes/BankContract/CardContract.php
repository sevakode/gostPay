<?php

namespace App\Classes;
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
    public function getCards($accountNumber = null): PromiseInterface|Response;

    /**
     * Метод получения списка карт
     *
     * @param int $ucid
     * @return PromiseInterface|Response
     */
    public function getCardInfo(int $ucid): PromiseInterface|Response;

    /**
     * Метод получения состояния карты
     *
     * @return PromiseInterface|Response
     * @var string $cardCode
     */
    public function getCardState(string $correlationId): PromiseInterface|Response;

    /**
     * Метод смены состояния карты
     *
     * @param string $cardCode
     * @param string $newState
     * @return PromiseInterface|Response
     */
    public function editCardState(string $cardCode, string $newState = 'lockedCard'): PromiseInterface|Response;

    /**
     * Метод закрытия карты
     *
     * @var string $cardCode
     * @var string $message
     * @return PromiseInterface|Response
     */
    public function deleteCard(string $cardCode, string $message = ''): PromiseInterface|Response;
}
