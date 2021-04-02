<?php

namespace App\Models\Bank;

use App\Classes\TochkaBank\BankAPI;
use App\Models\User;
use App\Notifications\DataNotification;
use App\Traits\ScopeNotifiable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\HasDatabaseNotifications;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;

/**
 * Class Card
 * @package App\Models\Bank
 *
 * @property string $number
 * @property string $numberFull
 * @property string $cvc
 * @property integer $head
 * @property integer $tail
 */
class Card extends Model
{
    use HasFactory, SoftDeletes, Notifiable, ScopeNotifiable;

    const ACTIVE = 'active';
    const PENDING = 'pending';
    const CLOSE = 'close';
    protected $dates = ['expiredAt', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'card_id');
    }

    public function scopeFree($query)
    {
        return $query
            ->where('user_id', null)
            ->has('payments', '==', null);
    }

    public function scopeIsDatePayments($query, Carbon $dateStart, Carbon $dateEnd)
    {
        return $query->whereHas('payments', function (Builder $query) use($dateStart, $dateEnd){
            $query->where('operationAt', '>=', $dateStart);
            $query->where('operationAt', '<=', $dateEnd);
        });
    }

    public function scopeExit($query)
    {
        foreach ($query->get() as $card) $card->project()->detach();

        $query->update(['user_id'=>null]);

        return $query;
    }


    public function exit()
    {
        $this->project()->detach();

        $this->user_id = null;
        $this->save();
    }

    public function project()
    {
        return $this->belongsToMany(Project::class, 'projects_cards');
    }

    public function getProjectAttribute()
    {
        return $this->project() ?
                $this->project()->first() :
                null;
    }

    public function updateNumberAttribute(string $value = null): void
    {
        $value = $value ? $value : $this->number;
        $number = self::getNumberSplit($value);
        if($number[1] === '****' and $number[2] === '****')
        {
            $value = isset($this->attributes['number']) ? Crypt::decryptString($this->attributes['number']) : $this->attributes['number'];
            $number = self::getNumberSplit($value);
        }

        $this->attributes['number'] = Crypt::encrypt($value);
        $this->attributes['head'] = $number[0];
        $this->attributes['tail'] = $number[3];
    }

    public static function getNumberSplit($number): array
    {
        $number = str_replace(' ', '', $number);
        return str_split($number, 4);
    }

    public static function parsePdf($PDF)
    {
        $texts = explode("\n", $PDF->getText());
        array_shift($texts);

        foreach ($texts as $text) {
            if (strpos($text, 'Карта')) continue;
            $text = preg_replace('/^([ ]+)|([ ]){2,}/m', '$2', $text);

            $cardsTx = explode(" ", preg_replace('/\p{Cc}+/u', '', $text));
            if(count($cardsTx) !== 9){
                DataNotification::sendErrors(['Файл поврежден. ID '. $cardsTx[0]], request()->user());
                continue;
            }
            $listCards[] = $cardsTx;

        }
        self::parsing($listCards);
    }

    public static function parseXlsx($XLSX)
    {
        $listCards = array();
        foreach ($XLSX as $text){
            preg_match("/(\d{16}) (\d{3}) ([0-1][0-9][\W][0-3][0-9])/", $text[0], $cardsAr);

            $number = self::getNumberSplit($cardsAr[1]);
            $cardsTxt = [$cardsAr[0]];

            unset($cardsAr[0]);
            unset($cardsAr[1]);

            $cardAr = array_merge($cardsTxt, $number, $cardsAr);
            $listCards[] = $cardAr;
        }
        self::parsing($listCards);
    }

    public static function parsing(array $listCards)
    {
        $cards = [];
        foreach ($listCards as $card) {
            $number = $card[1] . $card[2] . $card[3] . $card[4];
            $head = $card[1];
            $tail = $card[4];
            $date = explode('/',$card[6]);
            $expiredAt = Carbon::createFromFormat('m#y#d H', $card[6]. '-1 00');
            $cvc = $card[5];

            $count = 0;

            $isCard=Card::where('head', $head)->where('tail', $tail)->where('expiredAt', $date)->exists();
            if(!$isCard){
                $count++;
                $cards[] = [
                    'account_code' => $apiCard['account_code'] ?? null,
                    'bank_code' => $apiCard['bank_code'] ?? null,
                    'number' => $number,
                    'head' => $head,
                    'tail' => $tail,
                    'card_description' => $apiCard['card_description'] ?? null,
                    'card_type' => $apiCard['card_type'] ?? 'None',
                    'expiredAt' => $expiredAt,
                    'state' => self::ACTIVE,
                    'cvc' => $cvc,
                    'company_id' => request()->user()->company->id
                ];
            }

        }

        self::upsert(
            $cards,
            [
                'account_code',
                'bank_code',
                'number',
                'card_description',
                'head',
                'tail',
                'card_type',
                'expiredAt',
                'state',
                'cvc',
                'company_id',
            ]
        );
        Statement::refreshApi();
        Payment::refreshApi();
    }

    public static function getCollectApi(): \Illuminate\Support\Collection
    {
        $cardsApi = (new BankAPI(BankToken::first()))->getCards();

        if(!isset($cardsApi->Data)) {
            dd($cardsApi);
        }
        $cards =[];
        foreach ($cardsApi->Data->cards as $card) {
            $matches = self::getNumberSplit($card->maskedPan);
            $cards[] = collect([
                'account_code' => $card->accountCode,
                'bank_code' => $card->bankCode,
                'number' => $card->maskedPan,
                'head' => $matches[0],
                'tail' => $matches[3],
                'card_description' => $card->cardDescription,
                'card_type' => $card->cardProductType,
                'expiredAt' => Carbon::createFromFormat('m#y#d H', $card->expirationDate. '-1 00'),
                'state' => $card->previewState == 'Active'
            ]);
        }

        return collect($cards);
    }

    public static function refreshApi()
    {
        $cards = self::getCollectApi();

        self::upsert(
            $cards->toArray(),
            [
                'number',
                'card_description',
                'head',
                'tail',
                'card_type',
                'expiredAt',
                'state',
                'card_type'
            ]
        );
    }

    public function getAccountIdAttribute()
    {
        return $this->account_code .'/'. $this->bank_code;
    }

    public function getUserAttribute()
    {
        return $this->user()->first();
    }

    public function getStateAttribute()
    {
        return $this->attributes['state'] ? 'Активная' : 'Закрытая';
    }

    public function getNumberAttribute($val): string
    {
        if(!isset($this->attributes['number'])) return $val;
        $matches = self::getNumberSplit($this->attributes['number']);
        if(!is_numeric($matches[0]))
            $matches = self::getNumberSplit(Crypt::decrypt($this->attributes['number']));

        return $matches[0] . '********' . $matches[3];
    }

    public function getNumberFullAttribute()
    {
        $matches = self::getNumberSplit($this->attributes['number']);
        if(is_numeric($matches[0]))
            $result = $this->attributes['number'];
        else $result = Crypt::decrypt($this->attributes['number']);

        return $result;
    }

    public function getCvcAttribute($val)
    {
        if(!isset($this->attributes['cvc'])) return $val;
        if(is_numeric($this->attributes['cvc']))
            $result = $this->attributes['cvc'];
        else $result = Crypt::decrypt($this->attributes['cvc']);

        return $result;
    }

    public function getPayments()
    {
        return $this->payments()->where('amount', '>', 0);
    }

    public function amount(): int
    {
        return $this->amountExpenditure() - $this->amountRevenue();
    }

    public function amountExpenditure(): int
    {
        return (integer) $this->payments()->expenditure()->sum('amount');
    }

    public function amountRevenue(): int
    {
        return (integer) $this->payments()->revenue()->sum('amount');
    }
}
