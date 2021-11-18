<?php

namespace App\Classes;

use GuzzleHttp\Promise\PromiseInterface;
use Illuminate\Http\Client\Response;
/**
 * ----------------------------------------------------------------------------------------------------------------
 * Работа с платежами
 * ----------------------------------------------------------------------------------------------------------------
 */
interface PaymentContract
{
    /**
     * Метод получения статуса платежа
     *
     * @param string $requestId
     * @return PromiseInterface|Response
     */
    public function getPaymentStatus(string $requestId): PromiseInterface|Response;

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
    ): PromiseInterface|Response;
}
