<?php
namespace App\Classes\Tinkoff\Traits;

use Illuminate\Support\Facades\Http;

/**
 * Trait OpenBanking
 * @package App\Classes\TochkaBank\Traits
 */
trait OpenBanking
{
    public static string $LIMIT_TYPE_DAY = 'DAY';
    public static string $LIMIT_TYPE_MONTH = 'MONTH';
    public static string $LIMIT_TYPE_IRREGULAR = 'IRREGULAR';

    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа со счетами
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Метод получения списка доступных счетов
     *
     * @return object
     */
    public function getAccountsList(): object
    {
        $url = $this->bank->rsUrl.'/api/'.$this->bank->apiVersion.'/bank-accounts';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/bank-accounts/get'
        ];

        $response = Http::withHeaders($headers)->get($url);

        return (object) $response->object();
    }

    /**
     * Метод получения информации по конкретному счёту
     *
     * @param string $accountId
     * @return object
     */
//    public function getAccountInfo(string $accountId): object
//    {
//        $url = $this->bank->rsUrl.'/open-banking/'.$this->bank->apiVersion.'/accounts/'.$accountId;
//        $headers = [
//
//            'Authorization' => 'Bearer '. $this->bank->accessToken
//        ];
//
//        $response = Http::withHeaders($headers)->get($url);
//
//        return $response->object();
//    }


    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа с балансами счетов
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Метод получения баланса по нескольким счетам
     *
     * @return object
     */
    public function getBalancesList(): object
    {
        $url = $this->bank->rsUrl.'/open-banking/'.$this->bank->apiVersion.'/balances';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        $response = Http::withHeaders($headers)->get($url);

        return $response->object();
    }

    /**
     * Метод получения информации о балансе конкретного счета
     *
     * @param string $accountId
     * @return object
     */
    public function getBalanceInfo(string $accountId)
    {
        $url = $this->bank->rsUrl.'/open-banking/'.$this->bank->apiVersion.'/accounts/'.$accountId.'/balances';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        $response = Http::withHeaders($headers)->get($url);

        return $response->object();
    }


    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа с выписками
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Метод получения списка доступных выписок
     *
     * @return object
     */
    public function getStatementsList(): object
    {
        $url = $this->bank->rsUrl.'/open-banking/'.$this->bank->apiVersion.'/statements';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        $response = Http::withHeaders($headers)->get($url);

        return $response->object();
    }

    /**
     * Метод получения конкретной выписки
     *
     * @param string $accountId
     * @param string|null $statementId
     * @return object
     */
    public function getStatement(string $accountId, string $statementId = null): object
    {
        $url = $this->bank->rsUrl.'/api/'.$this->bank->apiVersion.'/bank-statement';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/bank-statements/get'
        ];

        $parameters = [
            'accountNumber' => $accountId
        ];

        $response = Http::withHeaders($headers)->get($url, $parameters);

        return (object) $response->json();
    }

    /**
     * Метод создания выписки по конкретному счету
     * @return object
     * @var string $accountId
     * @var string $startDateTime
     * @var string $endDateTime
     */
    public function initStatement(string $accountId, $startDateTime, $endDateTime): object
    {
        $url = $this->bank->rsUrl.'/api/v1/bank-statement';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/bank-statements/get'
        ];

        $parameters = [
            'accountNumber' => $accountId,
            'from' => $startDateTime,
            'till' => $endDateTime
        ];

        $response = Http::withHeaders($headers)->get($url, $parameters);

        return (object) $response->json();
    }


    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа с картами
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Метод получения списка карт
     *
     * @return object
     */
    public function getCards($accountNumber = null): object
    {
        $url = $this->bank->rsUrl.'/api/v1/card';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/card/get'
        ];

        $parameters = $accountNumber ? [
            'accountNumber' => $accountNumber,
        ] : [];

        $response = Http::withHeaders($headers)->get($url, $parameters);

        return (object) $response->json();
    }

    /**
     * Метод получения лимитов по картам
     *
     * @return object
     */
    public function getCardsLimits(): object
    {
        $url = $this->bank->rsUrl.'/card/'.$this->bank->apiVersion.'/cards/limits';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        $response = Http::withHeaders($headers)->get($url);

        return $response->object();
    }

    /**
     * Показывает действующие лимиты по карте
     *
     * @return object
     * @var string $cardCode
     */
    public function getCardLimits(string $cardCode): object
    {
        $url = $this->bank->rsUrl.'/card/'.$this->bank->apiVersion.'/card/'.$cardCode.'/limits';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        $response = Http::withHeaders($headers)->get($url);

        return $response->object();
    }

    /**
     * Показывает действующие лимиты по карте
     *https://enter.tochka.com/uapi/card/{apiVersion}/card/{cardCode}
     * @return object
     * @var string $cardCode
     */
    public function editCard(string $cardCode, string $newName): object
    {
        $url = $this->bank->rsUrl.'/card/'.$this->bank->apiVersion.'/card/'.$cardCode;
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        $data = '{
            "Data": {
                "newName": "'.$newName.'"
            }
        }';

        $response = Http::withHeaders($headers)->post($url, $data);

        return $response->object();
    }

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
     * @return object
     * @var string $cardCode
     */
    public function editCardLimits(string $ucid, $limitType = null, $limitPeriod = '1666'): object
    {
        $limitType = $limitType ?? self::$LIMIT_TYPE_DAY;

        $url = "https://secured-openapi.business.tinkoff.ru/api/v1/card/$ucid/spend-limit";
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0//card/limit/set'
        ];

        $parameters = [
            'limitValue' => $limitType,
            'limitPeriod' => $limitPeriod
        ];

        $response = Http::withHeaders($headers)->post($url, $parameters);

        return (object) $response->json();
    }

    /**
     * Метод получения состояния карты
     * string (Новый статус карты)
    Enum:
    "lockedCard"
    "unlockedCard"
     *
     * @return object
     * @var string $cardCode
     */
    public function getCardState(string $correlationId): object
    {
        $url = 'https://secured-openapi.business.tinkoff.ru/api/v1/card/virtual/reissue/result';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/card/virtual/reissue'
        ];

        $parameters = [
            'correlationId' => $correlationId,
        ];

        $response = Http::withHeaders($headers)->get($url, $parameters);

        return (object) $response->json();
    }

    /**
     * Метод смены состояния карты
     * string (Новый статус карты)
    Enum:
    "lockedCard"
    "unlockedCard"
     *
     * @return object
     * @var string $cardCode
     */
    public function editCardState(string $cardCode, string $newState = 'lockedCard'): object
    {
        $url = $this->bank->rsUrl . '/card/' . $this->bank->apiVersion . '/card/' . $cardCode . '/limits';
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken
        ];

        $data = '{
            "Data": {
                "newState": "'.$newState.'"
                }
        }';

        $response = Http::withHeaders($headers)->post($url, [$data]);

        return $response->object();
    }

    /**
     * Метод закрытия карты
     *
     * @var string $cardCode
     * @var string $message
     * @return object
     */
    public function deleteCard(string $cardCode, string $message = ''): object
    {
        $url = 'https://secured-openapi.business.tinkoff.ru/api/v1/card/virtual/reissue';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/card/virtual/reissue'
        ];

        $parameters = [
            'ucid' => $cardCode,
        ];

        $response = Http::withHeaders($headers)->post($url, $parameters);

        return (object) $response->json();
    }


    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа с клиентами
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Метод получения списка доступных клиентов
     *
     * @return object
     */
    public function getCustomersList(): object
    {
        $url = $this->bank->rsUrl . '/card/' . $this->bank->apiVersion . '/customers';
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken
        ];

        $response = Http::withHeaders($headers)->delete($url);

        return $response->object();
    }

    /**
     * Метод получения списка доступных клиентов
     * @var string $customerCode
     * @return object
     */
    public function getCustomerInfo(string $customerCode): object
    {
        $url = $this->bank->rsUrl . '/card/' . $this->bank->apiVersion . '/customers/'.$customerCode;
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken
        ];

        $response = Http::withHeaders($headers)->delete($url);

        return $response->object();
    }



    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа с клиентамиРабота с платежами
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Метод получения статуса платежа
     *
     * @return object
     */
    public function getPaymentStatus(string $requestId): object
    {
        $url = $this->bank->rsUrl . '/api/v1/payment/'.$requestId;
        $url = 'https://secured-openapi.business.tinkoff.ru/api/v1/payment/' . $requestId;
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/payments/rub-pay'
        ];

        $response = Http::withHeaders($headers)->get($url);

        return (object) $response->json();
    }

    /**
     * Метод получения статуса платежа
     *https://enter.tochka.com/uapi/payment/{apiVersion}/for-sign
     * @param string $requestId
     * @param $accountCode
     * @param $bankCode
     * @param $counterpartyBankBic
     * @param $counterpartyAccountNumber
     * @param $counterpartyINN
     * @param $counterpartyName
     * @param $paymentAmount
     * @param $paymentDate
     * @param $paymentNumber
     * @param $paymentPurpose
     * @param string $counterpartyKPP
     * @param string $paymentPriority
     * @param string $supplierBillId
     * @param string $taxInfoDocumentDate
     * @param string $taxInfoDocumentNumber
     * @param string $taxInfoKBK
     * @param string $taxInfoOKATO
     * @param string $taxInfoPeriod
     * @param string $taxInfoReasonCode
     * @param string $taxInfoStatus
     * @return object
     */
    public function createPaymentForSign(
        string $requestId,
        $accountCode,
        $bankCode,
        $counterpartyBankBic,
        $counterpartyAccountNumber,
        $counterpartyINN,
        $counterpartyName,
        $paymentAmount,
        $paymentDate,
        $paymentNumber,
        $paymentPurpose,

        $counterpartyKPP='',
        $paymentPriority='',
        $supplierBillId='',
        $taxInfoDocumentDate='',
        $taxInfoDocumentNumber='',
        $taxInfoKBK='',
        $taxInfoOKATO='',
        $taxInfoPeriod='',
        $taxInfoReasonCode='',
        $taxInfoStatus=''
    ): object
    {
        $url = $this->bank->rsUrl . '/payment/' . $this->bank->apiVersion . '/for-sign';
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken
        ];

        $data = '{
            "Data": {
                "accountCode": "'.$accountCode.'",
                "bankCode": "'.$bankCode.'",
                "counterpartyBankBic": "'.$counterpartyBankBic.'",
                "counterpartyAccountNumber": "'.$counterpartyAccountNumber.'",
                "counterpartyINN": "'.$counterpartyINN.'",
                "counterpartyKPP": "'.$counterpartyKPP.'",
                "counterpartyName": "'.$counterpartyName.'",
                "paymentAmount": "'.$paymentAmount.'",
                "paymentDate": "'.$paymentDate.'",
                "paymentNumber": "'.$paymentNumber.'",
                "paymentPriority": "'.$paymentPriority.'",
                "paymentPurpose": "'.$paymentPurpose.'",
                "supplierBillId": "'.$supplierBillId.'",
                "taxInfoDocumentDate": "'.$taxInfoDocumentDate.'",
                "taxInfoDocumentNumber": "'.$taxInfoDocumentNumber.'",
                "taxInfoKBK": "'.$taxInfoKBK.'",
                "taxInfoOKATO": "'.$taxInfoOKATO.'",
                "taxInfoPeriod": "'.$taxInfoPeriod.'",
                "taxInfoReasonCode": "'.$taxInfoReasonCode.'",
                "taxInfoStatus": "'.$taxInfoStatus.'",
            }
        }';

        $response = Http::withHeaders($headers)->post($url, [$data]);

        return $response->object();
    }
}
