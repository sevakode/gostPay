<?php

namespace App\Models;

use App\Interfaces\OptionsRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Role extends Model implements OptionsRole
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
