<?php

namespace App\Models\Bank;

use App\Classes\TochkaBank\BankAPI;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;

    public static function refreshApi()
    {
        self::truncate();
        $api = BankAPI::make()->getAccountsList();
        $statements = array();
        foreach ($api->Data->Account as $account)
        {
            $statement = BankAPI::make()->initStatement($account->accountId, '2020-08-01', now()->format('Y-m-d'));

            $statements[] = [
                'accountId' => $statement->Data->Statement->accountId,
                'statementId' => $statement->Data->Statement->statementId,
            ];
        }
        self::upsert($statements, ['accountId', 'statementId']);
    }
}
