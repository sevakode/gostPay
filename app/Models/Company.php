<?php

namespace App\Models;

use App\Models\Bank\TransactionBalance;
use App\Models\Bank\BankToken;
use App\Models\Bank\Card;
use App\Models\Bank\Account;
use App\Models\Bank\Project;
use App\Models\Pivot\PivotBalancesCompaniesUsers;
use App\Traits\HasProjects;
use App\Traits\Imageable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * @property $id
 * @property $name
 * @property $slug
 * @property $bank_id
 */
class Company extends Model
{
    use HasFactory, SoftDeletes, Imageable, HasProjects;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'bank_id'
    ];

    public function balance($account_id = null): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        $belongsToMany = $this->belongsToMany(TransactionBalance::class, PivotBalancesCompaniesUsers::class,
            'company_id', 'transaction_id');

        if ($account_id) $belongsToMany->where('bank_account_id', $account_id);

        return $belongsToMany;
    }

    public function scopeTransactionUser(Builder $query, $amount, $account_id, $user_id)
    {
        $query->whereHas('users', function ($query) use ($user_id) {
            $query->where('id', $user_id);
        });
        $query->whereHas('invoices', function ($query) use ($account_id) {
            $query->where('account_id', $account_id);
        });

        if (! $query->exists()) {
            return false;
        } else {
            $company = $query->first();
        }

        $company->transactionBalance($amount, $account_id, $user_id);

        $amountExpenditureCompany = 0 - $amount;
        $company->transactionBalance($amountExpenditureCompany, $account_id);

        return $company;
    }

    public function transactionBalance($amount, $account_id, $user_id = null)
    {
        $account = Account::where('account_id', $account_id)->first(['id']);

        $transactionObject = TransactionBalance::query()->create(['amount' => $amount]);
        $withPivot = [
            'bank_account_id' => $account->id,
            'user_id' => $user_id
        ];
        $this->balance($account_id)->attach($transactionObject, $withPivot);

        if ($user = User::find($user_id)) {
//            $user->checkBalance($account);
        }
//        $this->checkBalance($account);

        return $this;
    }

    public function checkBalance(Account $account)
    {

    }

    public function companyBalance($account_id = null): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->balance($account_id)->where('user_id', null);
    }

    public function bank()
    {
        return $this->hasOne(BankToken::class, 'company_id', 'id');
    }

    public function banks()
    {
        return $this->belongsToMany(BankToken::class, 'companies_bank_token');
    }

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'companies_permissions')
            ->withPivot('role_id as role_id');
    }

    public function invoices(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Account::class);
    }

    /**
     * @param $value
     * @return void
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function scopeWhereAccounts($query, array $accounts)
    {
        $query->whereHas('invoices', function (Builder $query) use($accounts){
            foreach ($accounts as $account) {
                $query->orwhere('account_id', 'like', $account .'%');
            }
        });

        return $query;
    }

    public function cards()
    {
        return $this->hasMany(Card::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function usersAll()
    {
        $users = $this->users()->whereHas('role', function ($query) {
            $query->where('slug', '!=', Permission::OWNER['slug']);
        });
        return $users;
    }

    public function sumCardsPayments()
    {
        $payments = 0;
        foreach ($this->users()->get() as $user)
            foreach ($user->cards()->get() as $card)
                $payments += $card->amount();

        return $payments;
    }

    public function sumCardsInvoices($invoice = Account::AVAIL)
    {
        return (int) $this->invoices()->sum($invoice);
    }

    public function getCurrency()
    {
        if($this->invoices()->where('currency', 'RUB')->exists())
            $currency = 'RUB';
        else $currency = 'USD';
        return $currency;
    }

    public function getCurrencySign()
    {
        switch ($this->getCurrency()) {
            case 'RUB' : $sign = '₽';
                break;
            case 'USD' : $sign = '$';
                break;
        }

        return $sign;
    }

    public function getAvatarAttribute(): string
    {
        return $this->avatar('original');
    }

    public function avatar($type)
    {
        return $this->getImage('avatar')->attributes[$type] ?? 'media/stock-600x400/img-70.jpg';
    }

    public function getAvatarSmallAttribute(): string
    {
        return $this->getImage('avatar')->attributes['small'] ?? '';
    }

    public function getBankAttribute()
    {
        return $this->bank()->first();
    }

    public function exportReportXls()
    {
        $excel[] = [
            'Номер транзакции',
            'Номер карты',
            'Детали операции',
            'Сумма в валюте счета',
            'Номер счета',
            'Пользователь карты',
            'Проект',
            'Дата транзакции',
        ];

        $dateStart = request()->get('date_start', now()->subMonths(6)->format('m-d-Y'));
        $dateEnd = request()->get('date_end', now()->format('m-d-Y'));

        if ($dateStart and $dateEnd) {
            $dateStart = Carbon::createFromFormat('m#d#Y', $dateStart)
                ->setTime(0,0,0);
            $dateEnd = Carbon::createFromFormat('m#d#Y', $dateEnd)
                ->setTime(0,0,0);

            $invoices = request()->user()->company->invoices();
            $payments = $invoices->payments()->where('card_id', '!=', 0)->isDate($dateStart, $dateEnd);

            foreach ($payments->with('cardQuery')->get() as $payment)
            {
                $number =  $payment->cardQuery ? $payment->cardQuery->numberFull : null;
                $fullname = null;
                $project = null;
                $amount = null;

                if($payment->card()) {
                    $fullname = $payment->card()->user()->first() ? $payment->card()->user()->first()->fullName : null;
                    $project = $payment->card()->project ? $payment->card()->project->name : null;
                    $amount = $payment->amount . ' ' . $payment->currency;
                }
                if(is_null($payment->amount)) dd($payment);

                $excel[] = array(
                    $payment->transaction_id,
                    $number,
                    $payment->description,
                    $amount,
                    $payment->account_id,
                    $fullname,
                    $project,
                    $payment->operationAt->format('M d, Y H:i:s') ?? $payment->update_at->format('M d, Y H:i:s') ?? null
                );
            }
        }

        return (new Collection($excel))->downloadExcel('report.xlsx', null, false);
    }
}
