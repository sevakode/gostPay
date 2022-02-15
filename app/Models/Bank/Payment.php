<?php

namespace App\Models\Bank;

use App\Classes\BankContract\CardLimitContract;
use App\Classes\Tinkoff\BankAPI as TinkOff;
use App\Models\Company;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Payment
 * @package App\Models\Bank
 * @property string $description
 * @property $card_id
 * @property $type
 * @property $amount
 */
class Payment extends Model
{
    use HasFactory, SoftDeletes;

    const EXPENDITURE='expenditure';
    const REVENUE='revenue';

    const BOOKED = 'booked';
    const PENDING = 'pending';
    const CANCELED = 'canceled';

    protected $fillable = [
        'transaction_id',
        'description',
        'account_id',
        'card_id',
        'type',
        'status',
        'amount',
        'currency',
        'operationAt',
    ];

    protected $dates = ['operationAt', 'updated_at'];

    public function card()
    {
        return Card::find($this->card_id);
    }

    public function cardQuery()
    {
        return $this->hasOne(Card::class, 'id', 'card_id');
    }

    public function queryCard(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Card::class, 'id', 'card_id');
    }

    public static function getCollectApi($api)
    {
        $data = array();

        $api->getPaymentsData($data);

        return collect($data);
    }

    public static function refreshApi($command = false, $banks=null)
    {
        $banks = $banks ?? BankToken::query()->get();
        $countCards = 0;
        $newPayments = collect();
        foreach ($banks as $bank)
        {
            if($bank->api()) {
                $payments = self::getCollectApi($bank->api());
                $paymentsExists = Payment::query()
                    ->whereIn('transaction_id', $payments->filter()->pluck('transaction_id'))
                    ->pluck('transaction_id')->toArray();

                $paymentsNotExists = $payments->filter()
                    ->whereNotIn('transaction_id', $paymentsExists)
                    ->map(function($payment) use ($payments, $paymentsExists) {
                        if(!is_array($payment))
                            return null;
                        return new Payment($payment);
                    });
                $newPayments = $newPayments->merge($paymentsNotExists)->filter();

                if (isset($payments['countCard'])) $countCards = $countCards + $payments['countCard'];
                unset($payments['countCard']);

                self::query()->upsert($payments->toArray(), ['transaction_id'],
                    [
                        'description',
                        'account_id',
                        'card_id',
                        'status',
                        'amount',
                        'currency',
                        'operationAt'
                    ]
                );
            }
        }

        self::setLimit($newPayments);
        self::setBalance($newPayments);

        if ($command) $command->info('Обновленные карты: '. $countCards);
        if ($command) $command->info('Обновленные платежы: '. $newPayments->count());
    }

    public static function setLimit($newPayments)
    {
        $newPayments->each(function (self $payment) {

            $card = Card::query()->find($payment->card_id);
            if ($card) {
                $bank = $card->bank()->first();
                $api = $bank->api();
                if ($api instanceof CardLimitContract) {
                    if (is_null($card->ucid)) {
                        Card::refreshUcidApi();
                        $card = Card::query()->find($card->id);
                    }
                    $response = $api->getCardLimits($card->ucid);
                    $limitInfo = $response->collect('spendLimit');
                    if ($limitInfo->count()) {
                        $card->limit = $limitInfo->get('limitRemain') == env('DEFAULT_CARD_LIMIT', 500000) ?
                            null :
                            $limitInfo->get('limitRemain');

                        $card->save();
                    }
                }
            }
        });
    }
    public static function setBalance($newPayments)
    {
        $newPayments->each(function (self $payment) {
            $company = Company::query()->whereHas('cards', function ($query) use($payment){
                $query->where('id', $payment->card_id ?? -1);
            })->with(['cards' => function ($query) use($payment){
                $query->where('id', $payment->card_id ?? -1);
            }])->first();
            if ($company and isset($company->cards)) {
                $card = $company->cards->first();

                if ($payment->type == self::EXPENDITURE) $amount = 0 - $payment->amount;
                else $amount = $payment->amount;

                $company->transactionBalance($amount, $card->account_code, $card->user_id);
            }
        });

        return true;
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


