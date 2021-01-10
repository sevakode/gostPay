<?php

namespace App\Models;

use App\Models\Bank\Card;
use App\Traits\HasCompanyAndPermissions;
use App\Traits\Imageable;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


/**
 * Class User
 * @package App\Models
 * @property $first_name
 * @property $last_name
 * @property $email
 * @property $password
 * @property $phone
 * @property $role_id
 * @property $company_id
 * @property Company $company
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRolesAndPermissions, HasCompanyAndPermissions, Imageable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'role_id',
        "company_id",
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cards()
    {
        return $this->company->cards()->where('user_id', $this->id);
    }

    /**
     * @param $value
     * @return string
     */
    public function getFirstNameAttribute($value): string
    {
        return ucfirst($value);
    }
    /**
     * @param $value
     * @return string
     */
    public function getLastNameAttribute($value): string
    {
        return ucfirst($value);
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return "$this->first_name $this->last_name";
    }

    /**
     * @return string
     */
    public function getShortnameAttribute(): string
    {
        $first = $this->first_name[0] ?? '';
        $last = $this->last_name[0] ?? '';
        return strtoupper("$first $last");
    }

    public function getAvatarAttribute(): string
    {
        return $this->getImage('avatar')->attributes['medium'] ?? '';
    }

    public function getAvatarSmallAttribute(): string
    {
        return $this->getImage('avatar')->attributes['small'] ?? '';
    }

    public function getCompanyAttribute()
    {
        return $this->company()->first();
    }

    public function getRoleAttribute()
    {
        return $this->role()->first();
    }


}
