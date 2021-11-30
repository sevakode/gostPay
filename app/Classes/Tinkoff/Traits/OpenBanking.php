<?php
namespace App\Classes\Tinkoff\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
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
     */
    public function getAccountsList(): Response
    {
        $url = $this->bank->rsUrl.'/api/'.$this->bank->apiVersion.'/bank-accounts';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/bank-accounts/get'
        ];

        return Http::withHeaders($headers)->get($url);
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
     * @param string|null $accountId
     * @return Response
     */
    public function getBalancesList(?string $accountId = null): Response
    {
        $url = $this->bank->rsUrl.'/open-banking/'.$this->bank->apiVersion.'/balances';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        return Http::withHeaders($headers)->get($url);
    }

    /**
     * Метод получения информации о балансе конкретного счета
     *
     * @param string $accountId
     * @return PromiseInterface|Response
     */
    public function getBalanceInfo(string $accountId): Response
    {
        $url = $this->bank->rsUrl.'/open-banking/'.$this->bank->apiVersion.'/accounts/'.$accountId.'/balances';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        $response = Http::withHeaders($headers)->get($url);

        return $response;
    }


    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа с выписками
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Метод получения списка доступных выписок
     *
     * @return PromiseInterface|Response
     */
    public function getStatementsList(): Response
    {
        $url = $this->bank->rsUrl.'/open-banking/'.$this->bank->apiVersion.'/statements';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        return Http::withHeaders($headers)->get($url);
    }

    /**
     * Метод получения конкретной выписки
     *
     * @param string $accountId
     * @param string|null $statementId
     * @return PromiseInterface|Response
     */
    public function getStatement(string $accountId, string $statementId = null): Response
    {
        $url = $this->bank->rsUrl.'/api/'.$this->bank->apiVersion.'/bank-statement';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/bank-statements/get'
        ];

        $parameters = [
            'accountNumber' => $accountId
        ];

        return Http::withHeaders($headers)->get($url, $parameters);
    }

    /**
     * Метод создания выписки по конкретному счету
     * @return PromiseInterface|Response
     * @var string $accountId
     * @var string $startDateTime
     * @var string $endDateTime
     */
    public function initStatement(string $accountId, string $startDateTime, string $endDateTime): Response
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

        return Http::withHeaders($headers)->get($url, $parameters);
    }


    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа с картами
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Метод получения списка карт
     *
     * @param null $accountNumber
     * @return PromiseInterface|Response
     */
    public function getCards($accountNumber = null): Response
    {
        $url = $this->bank->rsUrl.'/api/v1/card';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/card/get'
        ];

        $parameters = $accountNumber ? [
            'accountNumber' => $accountNumber,
        ] : [];

        return Http::withHeaders($headers)->get($url, $parameters);
    }

    /**
     * Метод получения списка карт
     *
     * @param int $ucid
     * @return PromiseInterface|Response
     */
    public function getCardInfo(int $ucid): Response
    {
        $url =  $this->bank->rsUrl.'/api/'.$this->bank->apiVersion.'/card/virtual/'.$ucid.'/requisites';

        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/card/virtual/requisites'
        ];

        return Http::withHeaders($headers)->get($url);
    }

    /**
     * Метод получения лимитов по картам
     *
     * @return PromiseInterface|Response
     */
    public function getCardsLimits(): Response
    {
        $url = $this->bank->rsUrl.'/api/v1/cards/limits';
        $url = $this->bank->rsUrl.'/api/v1/cards/limits';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        return Http::withHeaders($headers)->get($url);
    }

    /**
     * Показывает действующие лимиты по карте
     *
     * @return PromiseInterface|Response
     * @var string $cardCode
     */
    public function getCardLimits(string $cardCode): Response
    {
        $url = $this->bank->rsUrl.'/card/'.$this->bank->apiVersion.'/card/'.$cardCode.'/limits';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        return Http::withHeaders($headers)->get($url);
    }

    /**
     * Показывает действующие лимиты по карте
     *
     * @param string $cardCode
     * @param string $newName
     * @return PromiseInterface|Response
     */
    public function editCard(string $cardCode, string $newName): Response
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

        return Http::withHeaders($headers)->post($url, $data);
    }

    /**
     * Метод позволяет изменить следующие лимиты по карте:
     *
     * @param string $ucid
     * @param null $limitType
     * @param string $limitPeriod
     * @return PromiseInterface|Response
     */
    public function editCardLimits(string $ucid, $limitType = null, string $limitPeriod = '1666'): Response
    {
        $limitType = $limitType ?? self::$LIMIT_TYPE_DAY;

        $url = $this->bank->rsUrl.'/api/v1/card/'.$ucid.'/spend-limit';
        $url = 'https://business.tinkoff.ru/api/v1/card/'.$ucid.'/spend-limit';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/card/limit/set'
        ];

        $parameters = [
            'limitValue' => $limitType,
            'limitPeriod' => $limitPeriod
        ];

        return Http::withHeaders($headers)->post($url, $parameters);
    }

    /**
     * Метод получения состояния карты
     *
     * @return PromiseInterface|Response
     * @var string $cardCode
     */
    public function getCardState(string $correlationId): Response
    {
        $url = 'https://secured-openapi.business.tinkoff.ru/api/v1/card/virtual/reissue/result';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/card/virtual/reissue'
        ];

        $parameters = [
            'correlationId' => $correlationId,
        ];

        return Http::withHeaders($headers)->get($url, $parameters);
    }

    /**
     * Метод смены состояния карты
     *
     * @param string $cardCode
     * @param string $newState
     * @return PromiseInterface|Response
     */
    public function editCardState(string $cardCode, string $newState = 'lockedCard'): Response
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

        return Http::withHeaders($headers)->post($url, [$data]);
    }

    /**
     * Метод закрытия карты
     *
     * @var string $cardCode
     * @var string $message
     * @return PromiseInterface|Response
     */
    public function deleteCard(string $cardCode, string $message = ''): Response
    {
        $url = 'https://secured-openapi.business.tinkoff.ru/api/v1/card/virtual/reissue';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/card/virtual/reissue'
        ];

        $parameters = [
            'ucid' => $cardCode,
        ];

        return Http::withHeaders($headers)->post($url, $parameters);
    }


    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа с клиентами
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Метод получения списка доступных клиентов
     *
     * @return PromiseInterface|Response
     */
    public function getCustomersList(): Response
    {
        $url = $this->bank->rsUrl . '/card/' . $this->bank->apiVersion . '/customers';
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken
        ];

        return Http::withHeaders($headers)->delete($url);
    }

    /**
     * Метод получения списка доступных клиентов
     * @var string $customerCode
     * @return PromiseInterface|Response
     */
    public function getCustomerInfo(string $customerCode): Response
    {
        $url = $this->bank->rsUrl . '/card/' . $this->bank->apiVersion . '/customers/'.$customerCode;
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken
        ];

        return Http::withHeaders($headers)->delete($url);
    }



    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа с платежами
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Метод получения статуса платежа
     *
     * @param string $requestId
     * @return PromiseInterface|Response
     */
    public function getPaymentStatus(string $requestId): Response
    {
        $url = $this->bank->rsUrl . '/api/v1/payment/'.$requestId;
        $url = 'https://secured-openapi.business.tinkoff.ru/api/v1/payment/' . $requestId;
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken,
            'scope' => 'opensme/inn/246525853385/kpp/0/payments/rub-pay'
        ];

        return Http::withHeaders($headers)->get($url);
    }

    /**
     * Метод получения статуса платежа
     *
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
     * @return PromiseInterface|Response
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
    ): Response
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

        return Http::withHeaders($headers)->post($url, [$data]);
    }
}
