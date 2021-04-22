<?php

namespace App\Models\Bank;

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
}
