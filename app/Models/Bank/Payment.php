<?php

namespace App\Models\Bank;

use App\Interfaces\ApiGostPayment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

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

    public static function getCollectApi($api)
    {
        $data = array();

        $api->getPaymentsData($data);

        return collect($data);
    }

    public static function refreshApi($command = false)
    {
        $countCards = 0;
        foreach (BankToken::all() as $bank)
        {
            $payments = self::getCollectApi($bank->api());
            if(isset($payments['countCard'])) $countCards = $countCards + $payments['countCard'];
            unset($payments['countCard']);
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

        if($command) $command->info('Обновленные карты: '. $countCards);
    }

    public function number()
    {
        preg_match("/(\d{4})\**(\d{4})/", $this->description, $cards);

        return $cards[0] ?? null;
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


