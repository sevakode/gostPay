<?php

namespace App\Classes\BankContract;

use App\Models\Bank\Account;
use Illuminate\Support\Collection;

interface GenerateCardsContract
{
    /**
     * Метод получения лимитов по картам
     *
     * @param Account $account
     * @param int $count
     * @return Collection
     */
    public function createCards(Account $account, int $count = 1): Collection;

}
