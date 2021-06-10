<?php

namespace App\Models\Bank;

use App\Classes\TochkaBank\BankAPI;
use App\Interfaces\ApiGostPayment;
use App\Interfaces\ListBank;
use App\Models\Company;
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

    const AVAIL = 'avail';
    const CURRENT = 'current';

    protected $fillable = ['account_id', 'avail', 'current'];

    protected $table = 'bank_account';

    public function payment()
    {
        return Payment::where('account_id', $this->account_id);
    }

    public function scopePayments($query)
    {
        $accounts = $query->select('account_id')->get()->pluck('account_id');
        $whereInLike = function ($query) use($accounts) {
            foreach ($accounts as $account){
                $query->orwhere('account_id', 'like', $account .'%');
            }
        };

        return Payment::where($whereInLike);
    }

    public function cards()
    {
        $cards = Card::where('account_code', 'like', $this->account_id .'%');

        return $cards;
    }

    public function bank()
    {
        return $this->hasOne(BankToken::class, 'id', 'bank_token_id');
    }

    public function scopeCards($query)
    {
        $accounts = $query->select('account_id')->get()->pluck('account_id');

        $whereInLike = function ($query) use($accounts) {
            foreach ($accounts as $account) {
                $query->orWhere('account_code', 'like', $account .'%');
            }
        };

        return Card::where($whereInLike);
    }

    public function getCompanyAttribute()
    {
        return Company::find($this->company_id);
    }

    public function getBankAttribute()
    {
        if($this->bank()->exists()) {
            $bank = $this->bank()->first();
            $bankAr = collect(config('bank_list.info'))->where('url', $bank->url)->first();
        }
        else {
            $bankAr = [
                'title' => '',
                'icon' => '',
                'bin' => ''
            ];
        }

        return (object) $bankAr;
    }

    public function getBinAttribute()
    {
        $number = $this->cards()->select('number')->first()->numberFull ?? null;

        return substr($number, 0, 6);
    }

    public function getCurrencySignAttribute()
    {
        switch ($this->currency) {
            case 'RUB' : $sign = '₽';
                break;
            case 'USD' : $sign = '$';
                break;
            case 'EUR' : $sign = '€';
                break;
            case 'GBP' : $sign = '£';
                break;
        }

        return $sign;
    }

    public static function getCollectApi($api)
    {
        $data = array();

        $api->api()->getAccountsData($data);

        return collect($data);
    }

    public static function refreshApi()
    {
        foreach (BankToken::all() as $bank)
        {
            $collect = self::getCollectApi($bank);
            self::upsert(
                $collect->toArray(),
                [
                    'id',
                    'account_id',
                ],
                [
                    'currency', 'avail', 'current', 'bank_token_id'
                ]
            );
        }

        return true;
    }
}
