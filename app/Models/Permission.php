<?php

namespace App\Models;

use App\Interfaces\OptionsPermissions;
use App\Interfaces\OptionsRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Permission extends Model implements OptionsPermissions
{
    use HasFactory;

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
        $slug = $array['slug'] ?? Str::slug($array['title']);

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
