<?php

namespace App\Classes\Qiwi\Traits;

use Carbon\Carbon;
use Faker\Provider\ru_RU\Payment;
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
    public function getAccountsList(): Response
    {
        return $this->getAccountInfo();
    }

    /**
     * Метод получения информации по конкретному счёту
     *
     * @param string|null $accountId
     * @return Response
     */
    public function getAccountInfo(string $accountId = null): Response
    {
        $url = $this->bank->rsUrl . '/person-profile/' . $this->bank->apiVersion . '/profile/current';
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken
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
        $url = $this->bank->rsUrl . '/funding-sources/v2/persons/' . $accountId . '/accounts/';
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken
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
        $url = $this->bank->rsUrl . '/funding-sources/v2/persons/' . $accountId . '/accounts';
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken
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
//     */

    /**
     * Метод получения конкретной выписки
     *
     * @param string $accountId
     * @param string|null $statementId
     * @param Carbon $dateStart
     * @param Carbon $dateEnd
     * @return PromiseInterface|Response
     */
    public function getStatement(string $accountId, string $statementId = null, $dateStart = null, $dateEnd = null): Response
    {
        $url = $this->bank->rsUrl.'/payment-history/'.$this->bank->apiVersion.'/persons/'.$accountId.'/payments';
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken,
        ];

        $parameters = [
            'rows' => 50,
            'operation' => 'QIWI_CARD',
            'startDate' => $dateStart->toW3cString(),
            'endDate' => $dateEnd->toW3cString()
        ];

        return Http::withHeaders($headers)->get($url, $parameters);
    }

    /**
     * Метод создания выписки по конкретному счету
     * @param null $statementId
     * @param Carbon $startDateTime
     * @param Carbon $endDateTime
     * @return Response
     * @var string $accountId
     */
    public function initStatement(string $accountId, $startDateTime, $endDateTime, $statementId = null): Response
    {
        $url = $this->bank->rsUrl.'/payment-history/v1/persons/'.$accountId.'/cards/'.$statementId.'/statement';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
        ];

        $parameters = [
            'from' => $startDateTime->toW3cString(),
            'till' => $endDateTime->toW3cString()
        ];

        return Http::withHeaders($headers)->get($url, $parameters);
    }

    /**
     * ----------------------------------------------------------------------------------------------------------------
     * Работа с картами
     * ----------------------------------------------------------------------------------------------------------------
     */

    public function createOrderCard($accountNumber): Response
    {
        $url = $this->bank->rsUrl.'/cards/'.$this->bank->apiVersion.'/persons/'.$accountNumber.'/orders';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
        ];

        $parameters = [
            'cardAlias' => 'qvc-cpa-debit',
        ];

        return Http::withHeaders($headers)->post($url, $parameters);
    }

    public function submitOrderCard($accountNumber, $orderId): Response
    {
        $url = $this->bank->rsUrl.'/cards/'.$this->bank->apiVersion.'/persons/'.$accountNumber.'/orders/'.$orderId.'/submit';

        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
        ];

        return Http::withHeaders($headers)->put($url);
    }

    public function payOrderCard($accountNumber, $orderId, $number = null, $currency = '643'): Response
    {
        $number = $number ?? Payment::numerify('160088429####');
        $url = $this->bank->rsUrl.'/sinap/api/'.$this->bank->apiVersion.'/terms/32064/payments';
        $headers = [
            'Authorization' => 'Bearer '. $this->bank->accessToken,
        ];

        $parameters = [
            "id" => $number,
            "sum" => [
                "amount" => 99,
                "currency" => $currency
            ],
            "paymentMethod" => [
                "type" => "Account",
                "accountId" => $currency
            ],
            "fields" => [
                "account" => $accountNumber,
                "order_id" => $orderId
            ]
        ];

        return Http::withHeaders($headers)->post($url, $parameters);
    }

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
    public function getPaymentStatus(string $requestId): Response
    {
        $url = $this->bank->rsUrl . '/payment-history/'.$this->bank->apiVersion.'/transactions/'.$requestId;
        $headers = [
            'Authorization' => 'Bearer ' . $this->bank->accessToken
        ];

        return Http::withHeaders($headers)->get($url);
    }
}
