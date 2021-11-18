<?php

namespace App\Models\Bank;

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
        'id', 'amount'
    ];

    public function scopeGetSum($query): int
    {
        return $query->sum('amount');
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
}
