<?php

namespace App\Models\Bank;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'company_id'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'projects_users');
    }

    public function cards()
    {
        return $this->belongsToMany(Card::class, 'projects_cards');
    }

    public function getCompanyAttribute()
    {
        return $this->company()->get();
    }

    public function getAmountAllCards()
    {
        $amount = 0;
        foreach ($this->cards()->get() as $card) {
            $amount += $card->amount();
        }

        return $amount;
    }
}
