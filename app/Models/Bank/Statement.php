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
        $api = (new BankAPI(BankToken::first()));
        $accountList = $api->getAccountsList();
        $statements = array();

        if(!isset($accountList->Data)) $api->connectTokenRefresh();

        foreach ($accountList->Data->Account as $account)
        {
            $statement = $api->initStatement($account->accountId, '2020-08-01', now()->format('Y-m-d'));

            $statements[] = [
                'accountId' => $statement->Data->Statement->accountId,
                'statementId' => $statement->Data->Statement->statementId,
            ];
        }
        self::upsert($statements, ['accountId', 'statementId']);
    }
}
