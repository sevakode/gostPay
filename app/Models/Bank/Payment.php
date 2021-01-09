<?php

namespace App\Models\Bank;

use App\Classes\TochkaBank\BankAPI;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    public function __construct(array $attributes = [])
    {
//        self::refreshApi();
        parent::__construct($attributes);
    }

    public static function getCollectApi(): \Illuminate\Support\Collection
    {
        $api = BankAPI::make()->getBalancesList();
        if(!isset($api->Data)) {

        }
        $payments =[];
        foreach ($api->Data->Balance as $card) {
                $payments[] = collect([
                    'account_id' => $card->accountId,
                    'type' => $card->type,
                    'amount' => $card->Amount->amount,
                    'currency' => $card->Amount->currency,
                    'created_at' => new \DateTime($card->dateTime)
                ]);
        }

        return collect($payments);
    }

    public static function refreshApi()
    {
        $payments = self::getCollectApi();

        self::upsert(
            $payments->toArray(),
            [
                'account_id',
                'type',
                'amount',
                'currency',
            ]
        );
    }
}
