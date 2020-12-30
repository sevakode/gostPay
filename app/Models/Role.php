<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model
{
    use HasFactory;

    const
        OWNER = [
        'Owner'
    ],
        MANAGER = [
        'Manager'
    ],
        USER = [
        'User'
    ];

    const ALL = [ self::OWNER, self::MANAGER, self::USER ];

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

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'roles_permissions');
    }

    /**
     * @param $value
     * @return void
     */
    public function setNameAttribute($value): void
    {
        $this->attributes['name'] = $value;

        if(!isset($this->attributes['slug']))
            $this->attributes['slug'] = Str::slug($value);
    }
}
