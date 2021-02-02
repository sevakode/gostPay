<?php

namespace App\Models;

use App\Models\Bank\Card;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Company extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug'
    ];

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'companies_permissions');
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

    public function cards()
    {
        return Card::where('company_id', $this->id);
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
}
