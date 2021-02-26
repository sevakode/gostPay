<?php

namespace App\Models;

use App\Models\Bank\BankToken;
use App\Models\Bank\Card;
use App\Models\Bank\Project;
use App\Traits\HasProjects;
use App\Traits\Imageable;
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
        $excel = array();
        foreach ($this->users()->get() as $user)
        {
            foreach ($user->cards()->get() as $card)
            {
                $excel[] = array(
                    $card->amount(),
                    $card->number,
                    $user->fullname,
                    $card->project ? $card->project->name : null
                );
            }
        }
        return (new Collection($excel))->downloadExcel('report.xlsx', null, false);
    }
}
