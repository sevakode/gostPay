<?php
namespace App\Classes\Qiwi\Traits;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

/**
 * Trait OpenBanking
 * @package App\Classes\TochkaBank\Traits
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
     */
//    public function getAccountsList(): Response
//    {
//
//    }

    /**
     * Метод получения информации по конкретному счёту
     *
     * @param string|null $accountId
     * @return Response
     */
    public function getAccountInfo(string $accountId = null): Response
    {
        $url = $this->bank->rsUrl.'/person-profile/'.$this->bank->apiVersion.'/profile/current';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken
        ];

        $response = Http::withHeaders($headers)->get($url);

        return $response;
    }


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
    public function getBalancesList(?string $accountId = '79221032748'): Response
    {
        $url = $this->bank->rsUrl.'/funding-sources/v2/persons/'.$accountId.'/accounts/';
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
        $url = $this->bank->rsUrl.'/funding-sources/v2/persons/'.$accountId.'/accounts';
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
//    public function getStatementsList(): Response
//    {
//
//    }

    /**
     * Метод получения конкретной выписки
     *
     * @param string $accountId
     * @param string|null $statementId
     * @return PromiseInterface|Response
     */
    public function getStatement(string $accountId, string $statementId = null): Response
    {
        $url = $this->bank->rsUrl.'/payment-history/'.$this->bank->apiVersion.'/persons/'.$accountId.'/cards/'.$statementId.'/statement';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
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
//    public function initStatement(string $accountId, string $startDateTime, string $endDateTime): Response
//    {
//
//    }


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
        $url = $this->bank->rsUrl.'/cards/'.'v1'.'/cards';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
        ];

        $parameters = [
            'vas-alias' => 'qvc-master',
        ];

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
        $url =  $this->bank->rsUrl.'/cards/'.'v1'.'/cards/'.$ucid.'/details';

        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
        ];

        $parameters = [
            'operationId' => Str::uuid()->toString()
        ];

        return Http::withHeaders($headers)->put($url, $parameters);
    }

    /**
     * Метод получения лимитов по картам
     *
     * @return PromiseInterface|Response
     */
//    public function getCardsLimits(): Response
//    {
//
//    }

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
//    public function editCard(string $cardCode, string $newName): Response
//    {
//
//    }

    /**
     * Метод позволяет изменить следующие лимиты по карте:
     *
     * @param string $ucid
     * @param null $limitType
     * @param string $limitPeriod
     * @return PromiseInterface|Response
     */
//    public function editCardLimits(string $ucid, $limitType = null, string $limitPeriod = '1666'): Response
//    {
//
//    }

    /**
     * Метод получения состояния карты
     *
     * @return PromiseInterface|Response
     * @var string $cardCode
     */
//    public function getCardState(string $correlationId): Response
//    {
//
//    }

    /**
     * Метод смены состояния карты
     *
     * @param string $cardCode
     * @param string $newState
     * @return PromiseInterface|Response
     */
//    public function editCardState(string $cardCode, string $newState = 'lockedCard'): Response
//    {
//
//    }

    /**
     * Метод закрытия карты
     *
     * @var string $cardCode
     * @var string $message
     * @return PromiseInterface|Response
     */
    public function deleteCard(string $cardCode, string $message = ''): Response
    {
        $url = $this->bank->rsUrl.'/cards/'.$this->bank->apiVersion.'/persons/'.$cardCode.'/cards/'.$message.'/block';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
        ];

        return Http::withHeaders($headers)->put($url);
    }

    /**
     * Метод закрытия карты
     *
     * @var string $cardCode
     * @var string $message
     * @return PromiseInterface|Response
     */
    public function openCard(string $cardCode, string $message = ''): Response
    {
        $url = $this->bank->rsUrl.'/cards/'.$this->bank->apiVersion.'/persons/'.$cardCode.'/cards/'.$message.'/unblock';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
        ];

        return Http::withHeaders($headers)->put($url);
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
//    public function getPaymentStatus(string $requestId): Response
//    {
//
//    }

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
//    public function createPaymentForSign(
//        string $requestId,
//               $accountCode,
//               $bankCode,
//               $counterpartyBankBic,
//               $counterpartyAccountNumber,
//               $counterpartyINN,
//               $counterpartyName,
//               $paymentAmount,
//               $paymentDate,
//               $paymentNumber,
//               $paymentPurpose,
//
//               $counterpartyKPP='',
//               $paymentPriority='',
//               $supplierBillId='',
//               $taxInfoDocumentDate='',
//               $taxInfoDocumentNumber='',
//               $taxInfoKBK='',
//               $taxInfoOKATO='',
//               $taxInfoPeriod='',
//               $taxInfoReasonCode='',
//               $taxInfoStatus=''
//    ): Response
//    {
//
//    }
}
