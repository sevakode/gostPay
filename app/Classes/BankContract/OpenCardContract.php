<?php

namespace App\Classes\BankContract;

use App\Models\Bank\Account;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

interface OpenCardContract
{
    /**
     * Метод получения лимитов по картам
     *
     * @param string $cardCode
     * @param string $message
     * @return Response
     */
    public function openCard(string $cardCode, string $message = ''): Response;

}
