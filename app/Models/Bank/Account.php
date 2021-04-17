<?php

namespace App\Models\Bank;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Account
 * @package App\Models\Bank
 *
 * @property $account_id
 * @property $company_id
 * @property $avail
 * @property $current
 * @property $currency
 */
class Account extends Model
{
    use HasFactory;

    protected $fillable = ['account_id', 'avail', 'current'];

    protected $table = 'bank_account';

    public static function getCollectApi(): \Illuminate\Support\Collection
    {
////        dd(BankToken::first());
//        dd((new BankAPI(BankToken::first()))->getBalancesList());
//        $payments = array();
//        foreach (Statement::all() as $statement) {
//            $statement = (new BankAPI(BankToken::first()))->getStatement($statement->accountId, $statement->statementId);
//            foreach ($statement->Data->Statement[0]->Transaction as $payment)
//            {
//                preg_match("/карта (\d{4})\**(\d{4})/", $payment->description, $cards);
//                preg_match("/дата операции:([^q]{10})/", $payment->description, $data);
//
//                if(isset($cards[1], $cards[2])) {
//                    $cardId = Card::where('head', $cards[1])->where('tail', $cards[2])->first() ?
//                        Card::where('head', $cards[1])->where('tail', $cards[2])->first()->id :
//                        null;
//
//                    $payments[] = [
//                        'transaction_id' => $payment->transactionId,
//                        'description' => $payment->description,
//                        'account_id' => $statement->Data->Statement[0]->accountId,
//                        'card_id' => $cardId,
//                        'type' => $payment->creditDebitIndicator == 'Credit' ? self::REVENUE : self::EXPENDITURE,
//                        'status' => $payment->status,
//                        'amount' => $payment->Amount->amount,
//                        'currency' => $payment->Amount->currency,
//                        'operationAt' => Carbon::createFromFormat('d#m#Y', $data[1]),
//                    ];
//                }
//            }
//        }
//        return collect($payments);
    }

    public static function refreshApi()
    {
//        $payments = self::getCollectApi();
//        self::upsert(
//            $payments->toArray(),
//            [
//                'transaction_id',
//                'description',
//                'account_id',
//                'card_id',
//                'status',
//                'amount',
//                'currency',
//                'operationAt',
//            ]
//        );
    }
}
