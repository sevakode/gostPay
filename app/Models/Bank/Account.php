<?php

namespace App\Models\Bank;

use App\Classes\BankContract\GenerateCardsContract;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Class Account
 *
 * @package App\Models\Bank
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

    protected $fillable = ['account_id', 'avail', 'current', 'bank_token_id'];

    protected $table = 'bank_account';

    public function balance($company = null): BelongsToMany
    {
        $belongsToMany = $this->belongsToMany(TransactionBalance::class, 'transaction_balances_companies_users',
                'bank_account_id', 'transaction_id');
        if ($company) {
            $belongsToMany->wherePivot('company_id', $company);
        }

        return $belongsToMany;
    }

    public function scopeGetWhereCreateCards($query)
    {
        $query->with(['bank' => function($queryBank) {
            $queryBank->select([
                'id', 'title','url','rsUrl','apiVersion', 'bankId', 'bankSecret', 'accessToken', 'refreshToken'
            ]);
        }]);
        $result = $query->get()->map(function (Account $account) {
            if ($account->getRelation('bank')->api() instanceof GenerateCardsContract) {
                return $account;
            }
            return null;
        })->filter();

        return $result;
    }

    public function companyBalance($company = null): BelongsToMany
    {
        $belongsToMany = $this->balance();

        $belongsToMany->select(array_merge([
            'transaction_balances.id',
            'transaction_balances.amount',
            'transaction_balances.message'
        ], [
            'transaction_balances_companies_users.user_id as user_id',
            'transaction_balances_companies_users.company_id as company_id',
            'transaction_balances_companies_users.transaction_id as transaction_id',
        ]));
        return $belongsToMany;
    }

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

    public function company()
    {
        return $this->hasOne(Company::class, 'id', 'company_id');
    }

    public function getCompanyAttribute()
    {
        return Company::find($this->company_id);
    }

    public function getBankAttribute()
    {
        if($this->bank()->exists()) {
            $bank = $this->bank()->select('url')->first();
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

        if($api->api())
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
