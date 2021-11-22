<?php

namespace App\Classes;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;

interface CardLimitContract
{
    /**
     * Метод получения лимитов по картам
     *
     * @return PromiseInterface|Response
     */
    public function getCardsLimits(): Response;

    /**
     * Показывает действующие лимиты по карте
     *
     * @return PromiseInterface|Response
     * @var string $cardCode
     */
    public function getCardLimits(string $cardCode): Response;

    /**
     * Показывает действующие лимиты по карте
     *
     * @param string $cardCode
     * @param string $newName
     * @return PromiseInterface|Response
     */
    public function editCard(string $cardCode, string $newName): Response;

    /**
     * Метод позволяет изменить следующие лимиты по карте:
     * MaxAtmOperationSumPerDay - Максимальная сумма операций за день через банкоматы и ПВН
     * MaxAtmOperationSumPerMonth - Максимальная сумма операций за месяц через банкоматы и ПВН
     * MaxTspOperationSumPerDay - Максимальная сумма операций за день в ТСП
     * MaxTspOperationSumPerMonth - Максимальная сумма операций за месяц в ТСП
     * MaxInternetOperationSumPerDay - Максимальная сумма операций за день, приобретаемых в Internet
     * MaxInternetOperationSumPerMonth - Максимальная сумма операций за месяц, приобретаемых в Internet
     * CommonSpendingLimitCard - Накопительный лимит всех трат за все время
     * Zagranica - Разрешены или нет операции за рубежом по карте
     *
     * Особенности:
     * CommonSpendingLimitCard - является накопительным и никогда не сбрасывается.
     * Zagranica - принимает только два значения: 0/1 (нельзя/можно использловать карту в других странах.
     * Лимиты изменяются в течение 0,2 секунды.
     * Дневной лимит обновляется в 23:59 мск.
     * Месячный лимит обновляется в последний день месяца в 23:59 мск.
     *
     * @param string $ucid
     * @param null $limitType
     * @param string $limitPeriod
     * @return PromiseInterface|Response
     */
    public function editCardLimits(string $ucid, $limitType = null, string $limitPeriod = '1666'): Response;
}
