<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model
{
    use HasFactory;

    const
        OWNER = [
        'Owner'
    ],
        MANAGER_ROLE_SET = [
        'Manager role set'
    ];

    const ALL = [
        self::OWNER,
        self::MANAGER_ROLE_SET
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'slug'
    ];

    public static function getSlug($array)
    {
        $slug = $array[1] ?? Str::slug($array[0]);

        return self::where('slug', $slug)->first();
    }

    public function roles(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'permissions_roles');
    }

    public function companies(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Company::class, 'companies_permissions');
    }

    public function setNameAttribute($value){
        $this->attributes['name'] = $value;

        if(!isset($this->attributes['slug']))
            $this->attributes['slug'] = Str::slug($value);
    }
}
