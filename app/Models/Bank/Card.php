<?php

namespace App\Models\Bank;

use App\Classes\TochkaBank\BankAPI;
use App\Models\Company;
use App\Models\User;
use App\Notifications\DataNotification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class Card extends Model
{
    use HasFactory;

    protected $dates = ['expiredAt'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function geo()
    {
        return $this->belongsTo(Geo::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'card_id');
    }

    public function getAccountIdAttribute()
    {
        return $this->account_code .'/'. $this->bank_code;
    }

    public function getUserAttribute()
    {
        return $this->user()->first();
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

        $this->attributes['head'] = $number[0];
        $this->attributes['tail'] = $number[3];
    }

    public function setNumberAttribute(string $value): void
    {
        $this->updateNumberAttribute($value);
    }

    private static function getNumberSplit($number): array
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

            $cardsTx = explode(" ", preg_replace('/\p{Cc}+/u', '', $text));

            $listCards[] = $cardsTx;
        }
        self::parsing($listCards);
    }

    public static function parseXlsx($XLSX)
    {
        $listCards = array();
        foreach ($XLSX as $text){
            preg_match("/(\d{4}) (\d{4}) (\d{4}) (\d{4}) ([^q]{5}) (\d{3})/", $text[0], $cardsTx);
            $listCards[] = $cardsTx;
        }
        self::parsing($listCards);
    }

    public static function parsing(array $listCards)
    {
        $cards = [];
        $apiCards = Card::getCollectApi();
        foreach ($listCards as $card) {

            $number = $card[1] . $card[2] . $card[3] . $card[4];
            $head = $card[1];
            $tail = $card[4];
            $date = explode('/',$card[5]);
            $expiredAt = new Carbon("$date[0]/1/$date[1] 0:0:0");
            $cvc = $card[6];

            $isCard=Card::where('head', $head)->where('tail', $tail)->where('expiredAt', $date)->exists();
            $apiCard = $apiCards
                ->where('head', $head)
                ->where('tail', $tail)
                ->where('expiredAt', $expiredAt)
                ->first();

            if(!$isCard and $apiCard){
                $cards[] = [
                    'account_code' => $apiCard['account_code'] ?? null,
                    'bank_code' => $apiCard['bank_code'] ?? null,
                    'number' => $number,
                    'head' => $head,
                    'tail' => $tail,
                    'card_description' => $apiCard['card_description'] ?? null,
                    'card_type' => $apiCard['card_type'] ?? 'None',
                    'expiredAt' => $expiredAt,
                    'state' => isset($apiCard['state']) ? $apiCard['state'] : true,
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
        $cardsApi = BankAPI::make()->getCards();

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
                'state'
            ]
        );
    }

    public function getStateAttribute()
    {
        return $this->attributes['state'] ? 'Активная' : 'Закрытая';
    }

    public function getNumberAttribute()
    {
        $matches = self::getNumberSplit($this->attributes['number']);
        return $matches[0] . '********' . $matches[3];
    }

    public function getNumberFullAttribute()
    {
        return $this->attributes['number'];
    }

    public static function all($columns = ['*'])
    {
        return parent::all($columns); // TODO: Change the autogenerated stub
    }

    public function getPayments()
    {
        return $this->payments()->where('amount', '>', 0);

    }

    public function amount()
    {
        return $this->payments()
            ->sum('amount');
    }
}
