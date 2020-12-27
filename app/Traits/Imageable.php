<?php namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait Imageable
{
    private imageable;
    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     * @var $this User
     */
    public function image()
    {
        return $this->morphMany(\App\Models\Image::class, 'imageable')->select('*');
    }

    public function images()
    {
        $this->attributes  = $this->morphMany(\App\Models\ImagesMany::class, 'imageable')->select('*');
        return
    }

    public function saveImage($file, $path = '')
    {
        $filename = Str::random(). '.' .$file->extension();
        $dirpath = $path;
        $basepath = public_path($path) . $filename;
        $filepath = $dirpath.$filename;

        $this->ifDirEmpty($dirpath);

        Image::make($file)->save($basepath);

        return $this->images()->updateOrCreate(['image_original' => asset($filepath)]);
    }

    private function ifDirEmpty($path)
    {
        if(!file_exists($path)) mkdir($path, 0777, true);
    }
}
