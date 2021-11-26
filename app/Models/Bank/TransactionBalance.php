<?php

namespace App\Models\Bank;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $amount
 *
 * @method revenue($amount): self
 * @method expenditure($amount): self
 */
class TransactionBalance extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'id', 'amount', 'message'
    ];

    public function scopeGetSum($query): float
    {
        return round($query->sum('amount'), 2);
    }

    public function scopeWhereUser($query, $user_id)
    {
        return $query->where('transaction_balances_companies_users.user_id', $user_id);
    }

    public function scopeRevenue($query, int $amount)
    {
        return $query->attach([
            'amount' => $amount
        ]);
    }

    public function scopeExpenditure($query, int $amount)
    {
        $amount = $amount > 0 ? 0 - $amount : $amount;
        return $query->create([
            'amount' => $amount
        ]);
    }

    public function account(): HasOne
    {
        return $this->hasOne(Account::class, 'bank_account_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function type(): string
    {
        return $this->amount >= 0 ? Payment::REVENUE : Payment::EXPENDITURE;
    }
}
