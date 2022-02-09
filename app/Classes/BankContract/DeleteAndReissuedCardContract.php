<?php

namespace App\Classes\BankContract;

use Illuminate\Http\Client\Response;

interface DeleteAndReissuedCardContract extends ReissuedCardContract, CloseCardContract
{
    /**
     * Метод получения лимитов по картам
     *
     * @param string $cardCode
     * @param string $message
     * @return Response
     */
    public function reissuedCard(string $correlationId);

}
