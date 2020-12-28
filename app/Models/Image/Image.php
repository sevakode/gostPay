<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\File;

class Image extends Model
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

    /**
     * @param $value
     */
    public function setOriginalAttribute($value)
    {
        $this->attributes['original'] = $this->updateOriginal($value);
        $this->attributes['small'] = $this->updateSmall($value);
        $this->attributes['original'] = null;
        $this->attributes['original'] = null;
    }


    private function updateOriginal($value): string
    {
        $file = new File($value);
        $image = \Intervention\Image\Facades\Image::make($file);

        $this->recursiveRemoveAllFiles($file->getPath());
        $image->save(public_path($value));

        return $value;
    }

    private function updateSmall($value): string
    {
        $file = new File($value);
        $dirpath = str_replace('original', 'small/',$file->getPath());
        $image = \Intervention\Image\Facades\Image::make($file);
        $filename = "$image->filename.$image->extension";

        $this->mkdirIfEmpty($dirpath);

        $aspectRatio = function ($constraint) {
            $constraint->aspectRatio();
        };

        if($this->attributes['original'] and file_exists(public_path($this->attributes['small']))){
            \Intervention\Image\Facades\Image::make(new File($this->attributes['small']))->destroy();
            $this->recursiveRemoveAllFiles($file->getPath());
        }

        $small = $image->resize(300, 300, $aspectRatio)->save($dirpath . $filename);
        return $small->basePath();
    }

    /**
     * Проверяет и создает нужную директорию для файла
     *
     * @param $path
     */
    private function mkdirIfEmpty($path)
    {
        if(!file_exists($path)) mkdir($path, 0777, true);
    }


    private function recursiveRemoveAllFiles($dir)
    {
        $includes = glob($dir.'/*');

        foreach ($includes as $include) unlink($include);
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
