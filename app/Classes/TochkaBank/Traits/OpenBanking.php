<?php
namespace App\Classes\TochkaBank\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

/**
 * Trait OpenBanking
 * @package App\Classes\TochkaBank\Traits
 * @implements
 */
trait OpenBanking
{
    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа со счетами
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Метод получения списка доступных счетов
     *
     * @return PromiseInterface|Response
     */
    public function getAccountsList(): Response
    {
        $url = $this->bank->rsUrl.'/open-banking/'.$this->bank->apiVersion.'/accounts';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        return Http::withHeaders($headers)->get($url);
    }

    /**
     * Метод получения информации по конкретному счёту
     *
     * @param string $accountId
     * @return PromiseInterface|Response
     */
    public function getAccountInfo(string $accountId): Response
    {
        $url = $this->bank->rsUrl.'/open-banking/'.$this->bank->apiVersion.'/accounts/'.$accountId;
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        return Http::withHeaders($headers)->get($url);
    }


    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа с балансами счетов
     * ----------------------------------------------------------------------------------------------------------------
     */

    /**
     * Метод получения баланса по нескольким счетам
     *
     * @return PromiseInterface|Response
     */
    public function getBalancesList(): Response
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

        return Http::withHeaders($headers)->get($url);
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
     * @param string $statementId
     * @return PromiseInterface|Response
     */
    public function getStatement(string $accountId, string $statementId = null): Response
    {
        $url = $this->bank->rsUrl.'/open-banking/'.$this->bank->apiVersion.'/accounts/'.$accountId.'/statements/'.$statementId;
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        return Http::withHeaders($headers)->get($url);
    }

    /**
     * Метод создания выписки по конкретному счету
     * @return PromiseInterface|Response
     * @var string $accountId
     * @var string $startDateTime
     * @var string $endDateTime
     */
    public function initStatement(string $accountId, $startDateTime, $endDateTime): Response
    {
        $url = $this->bank->rsUrl.'/open-banking/'.$this->bank->apiVersion.'/statements';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
            'Content-Type' => 'application/json',
        ];

        $data = [
            "Data" => [
                "Statement" => [
                    "accountId" => $accountId,
                    "startDateTime" => $startDateTime,
                    "endDateTime" => $endDateTime
                ]
            ]
        ];

        return Http::withHeaders($headers)->post($url, $data);
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
        //https://business.tinkoff.ru/openapi/api/v1/card
        $url = $this->bank->rsUrl.'/card/'.$this->bank->apiVersion.'/card';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
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
        $url = $this->bank->rsUrl.'/card/'.$this->bank->apiVersion.'/cards/limits';
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
     *https://enter.tochka.com/uapi/card/{apiVersion}/card/{cardCode}
     * @return PromiseInterface|Response
     * @var string $cardCode
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
     * @return PromiseInterface|Response
     * @var string $cardCode
     */
    public function editCardLimits(string $cardCode, $limitType = 'MaxAtmOperationSumPerDay', $newValue = '1666'): Response
    {
        $url = $this->bank->rsUrl.'/card/'.$this->bank->apiVersion.'/card/'.$cardCode.'/limits';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        $data = '{
            "Data": {
                "Limits": [
                    {
                        "limit_type": "'.$limitType.'",
                        "new_value": '.$newValue.'
                    }
                ]
            }
        }';

        $response = Http::withHeaders($headers)->post($url, [$data]);

        return $response;
    }

     /**
      * Метод смены состояния карты
      * string (Новый статус карты)
         Enum:
         "lockedCard"
         "unlockedCard"
      *
      * @return PromiseInterface|Response
      * @var string $cardCode
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
        $url = $this->bank->rsUrl . '/card/' . $this->bank->apiVersion . '/card/' . $cardCode;
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken
        ];

        $data = '{
            "Data": {
                "message": "'.$message.'"
            }
        }';

        return Http::withHeaders($headers)->delete($url);
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
     * Работа с клиентамиРабота с платежами
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
        $url = $this->bank->rsUrl . '/payment/' . $this->bank->apiVersion . '/status/'.$requestId;
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken
        ];

        return Http::withHeaders($headers)->get($url);
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
