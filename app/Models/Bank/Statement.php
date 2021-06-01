<?php

namespace App\Models\Bank;

use App\Classes\TochkaBank\BankAPI;
use App\Interfaces\ApiGostPayment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statement extends Model
{
    use HasFactory;

    public static function getCollectApi($api)
    {
        $data = array();

        $api->getStatementsData($data);

        return $data;
    }

    public static function refreshApi()
    {
        $statements = array();

        if(BankToken::exists()) self::truncate();

        foreach (BankToken::all() as $bank) {
            $api = (new BankAPI($bank));
            $statements = array_merge($statements, self::getCollectApi($api));
        }

        self::upsert($statements, ['accountId', 'statementId']);
    }
}
