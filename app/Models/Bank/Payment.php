<?php

namespace App\Models\Bank;

use App\Classes\TochkaBank\BankAPI;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payment
 * @package App\Models\Bank
 *
 * @property string $description
 */
class Payment extends Model
{
    use HasFactory, SoftDeletes;

    const EXPENDITURE='expenditure';
    const REVENUE='revenue';

    const BOOKED = 'booked';
    const PENDING = 'pending';
    const CANCELED = 'canceled';

    protected $dates = ['operationAt', 'updated_at'];

    public function card()
    {
        return Card::find($this->card_id);
    }

    public static function getCollectApi(): \Illuminate\Support\Collection
    {
        $payments = array();
        foreach (Statement::all() as $statement) {
            $statement = (new BankAPI(BankToken::first()))->getStatement($statement->accountId, $statement->statementId);
            foreach ($statement->Data->Statement[0]->Transaction as $payment)
            {
                preg_match("/карта (\d{4})\**(\d{4})/", $payment->description, $cards);
                preg_match("/дата операции:([^q]{10})/", $payment->description, $data);

                if(isset($cards[1], $cards[2])) {
                    if(!Payment::where('transaction_id', $payment->transactionId)->exists()) {
                        $cardId = Card::where('head', $cards[1])->where('tail', $cards[2])->first() ?
                            Card::where('head', $cards[1])->where('tail', $cards[2])->first()->id :
                            null;

                        $payments[] = [
                            'transaction_id' => $payment->transactionId,
                            'description' => $payment->description,
                            'account_id' => $statement->Data->Statement[0]->accountId,
                            'card_id' => $cardId,
                            'type' => $payment->creditDebitIndicator == 'Credit' ? self::REVENUE : self::EXPENDITURE,
                            'status' => $payment->status,
                            'amount' => $payment->Amount->amount,
                            'currency' => $payment->Amount->currency,
                            'operationAt' => Carbon::createFromFormat('d#m#Y H', $data[1] . ' 00'),
                        ];
                    }
                    else {
                        $cardId = Card::where('head', $cards[1])->where('tail', $cards[2])->first() ?
                            Card::where('head', $cards[1])->where('tail', $cards[2])->first()->id :
                            null;

                        $payment = Payment::where('transaction_id', $payment->transactionId)->first();
                        $payment->card_id = $cardId;
                        $payment->save();
                    }
                }

            }
        }
        return collect($payments);
    }

    public static function refreshApi()
    {
        $payments = self::getCollectApi();
        self::upsert(
            $payments->toArray(),
            [
                'transaction_id',
                'description',
                'account_id',
                'card_id',
                'status',
                'amount',
                'currency',
                'operationAt',
            ]
        );
    }

    public function number()
    {
        preg_match("/(\d{4})\**(\d{4})/", $this->description, $cards);

        return $cards[0];
    }

    public function scopeExpenditure($query)
    {
        return $query->where('type', Payment::EXPENDITURE);
    }

    public function scopeRevenue($query)
    {
        return $query->where('type', Payment::REVENUE);
    }

    public function scopeGetNotCards($query)
    {
        $whereInNumber = function ($payment) {
            preg_match("/(\d{4})\**(\d{4})/", $payment->description, $cards);

            if (isset($cards[2])) return false;
            return true;
        };

        return $query->where('card_id', '=', null)->get()->filter($whereInNumber);
    }

    public function scopeGetCards($query)
    {
        $whereInNumber = function ($payment) {
            preg_match("/(\d{4})\**(\d{4})/", $payment->description, $cards);
            if (!isset($cards[2])) return false;

            $isCard = request()->user()->cards()->where('head', $cards[1])->where('tail', $cards[2])->exists();

            if (!$isCard) return false;

            return true;
        };

        return $query->where('card_id', '!=', null)
            ->select(['type', 'amount', 'currency', 'description'])
            ->get()->filter($whereInNumber);
    }

    public function scopeNowDay($query)
    {
        return $query->where("created_at", ">=", date("Y-m-d H:i:s", strtotime('-24 hours', time())));
    }

    public function scopeIsDate($query, Carbon $dateStart, Carbon $dateEnd)
    {
        return $query->where('operationAt', '>=', $dateStart)->where('operationAt', '<=', $dateEnd);
    }
}
