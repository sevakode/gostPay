<?php

namespace App\Classes\BankContract;

use Illuminate\Http\Client\Response;

interface ReissuedCardContract
{
    /**
     * Метод получения лимитов по картам
     *
     * @param string $cardCode
     * @param string $message
     * @return Response
     */
    public function getStatusForReissuedCard(string $correlationId): Response;

}
