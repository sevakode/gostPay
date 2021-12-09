<?php

namespace App\Classes\BankContract;

use App\Models\Bank\Account;
use Illuminate\Support\Collection;
use Illuminate\Http\Client\Response;

interface StateCardContract
{
    /**
     * Метод получения лимитов по картам
     *
     * @param string $correlationId
     * @return Response
     */
    public function getCardState(string $correlationId): Response;

}
