<?php

namespace App\Models;

use App\Traits\Imageable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, Imageable;

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

    /**
     * @return string
     */
    public function getFullnameAttribute(): string
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


}
