<?php

namespace App\Models;

use App\Models\Bank\BankToken;
use App\Models\Bank\Card;
use App\Models\Bank\Account;
use App\Models\Bank\Payment;
use App\Models\Bank\Project;
use App\Traits\HasProjects;
use App\Traits\Imageable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

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
        return $this->belongsToMany(Permission::class, 'companies_permissions');
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
        return Card::where('company_id', $this->id);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function users()
    {
        return User::where('company_id', $this->id);
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
        return $this->getImage('avatar')->attributes[$type] ?? asset('media/stock-600x400/img-70.jpg');
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
            'номер',
            'описание',
            'сумма',
            'реквезиты',
            'карта',
            'пользователь',
            'проект',
            'дата',
        ];

        $dateStart = request()->get('date_start');
        $dateEnd = request()->get('date_end');

        if ($dateStart and $dateEnd) {
            $dateStart = Carbon::createFromFormat('m#d#Y', $dateStart)
                ->setTime(0,0,0);
            $dateEnd = Carbon::createFromFormat('m#d#Y', $dateEnd)
                ->setTime(0,0,0);

            $invoices = request()->user()->company->invoices();
            $payments = $invoices->payments()->isDate($dateStart, $dateEnd);
        }

        foreach ($payments->get() as $payment)
        {
            $excel[] = array(
                $payment->transaction_id,
                $payment->description,
                $payment->amount . ' ' . $payment->currency != null ? $payment->currency : 'RUB',
                $payment->account_id,
                $payment->number() ?? null,
                $payment->card()->user()->first()->fullName ?? null,
                $payment->card()->project ? $payment->card()->project->name : null,
                $payment->operationAt->format('M d, Y H:i:s') ?? $payment->update_at->format('M d, Y H:i:s') ?? null
            );
        }
        dd($excel);

        return (new Collection($excel))->downloadExcel('report.xlsx', null, false);
    }
}
