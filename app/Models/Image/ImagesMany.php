<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagesMany extends Model
{
    use HasFactory;

    protected $fillable = array(
        'type',
        'small',
        'medium',
        'large',
        'original',
        'imageable_type',
        'imageable_id',
    );

    public function getTypeAttribute()
    {
        return $this->image_type;
    }

    public function getSmallAttribute()
    {
        return $this->image_small;
    }

    public function getMediumAttribute()
    {
        return $this->image_medium;
    }

    public function getLargeAttribute()
    {
        return $this->image_large;
    }

    public function getOriginalAttribute()
    {
        return $this->image_original;
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
