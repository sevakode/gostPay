<?php

namespace App\Classes\BankContract;

use App\Models\Bank\Account;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;

interface CloseCardContract
{
    /**
     * Метод получения лимитов по картам
     *
     * @param string $cardCode
     * @param string $message
     * @return Response
     */
    public function deleteCard(string $cardCode, string $message = ''): Response;

}
