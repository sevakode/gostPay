<?php namespace App\Traits;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

trait Imageable
{
    /**
     * Создает связь между Моделью и Image
     *
     * @return $this
     */
    public function image($type)
    {
        $this->attributes['type'] = $type;
        $this->attributes['imageable'] = $this->morphMany(\App\Models\Image\Image::class, 'imageable')
            ->select('*')->where('type', $type);
        return $this;
    }

    /**
     * Создает связь между Моделью и ImagesMany
     *
     * @return $this
     */
    public function images($type)
    {
        $this->attributes['type'] = $type;
        $this->attributes['imageable'] = $this->morphMany(\App\Models\Image\ImagesMany::class, 'imageable')
            ->select('*')->where('type', $type);

        return $this;
    }

    /**
     * Создает или обновляет изображения для модели
     *
     * @param $file
     * @param string $dirpath
     * @return mixed
     */
    public function make($file, $dirpath = '')
    {
        $filename = Str::random(). '.' .$file->extension();
        $basepath = public_path($dirpath) . $filename;
        $filepath = $dirpath.$filename;

        $this->mkdirIfEmpty($dirpath);

        Image::make($file)->save($basepath);
        $result = $this->imageable
            ->updateOrCreate([
                    'type' => $this->type,
                    'imageable_id' => $this->id
                ], [
                    'original' => $filepath,
                ]);

        return $result;
    }

    /**
     * Возвращает модель с изображением
     *
     * @param null $type
//     * @return \App\Models\Image\Image
     */
    public function getImage($type = null)
    {
        if($type) $this->image($type);
        return $this->imageable->first();
    }

    /**
     * Возвращает модель с изображениями
     *
     * @param null $type
//     * @return ImagesMany
     */
    public function getImages($type = null)
    {
        if($type) $this->image($type);

        return $this->imageable->get();
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

    /**
     * Если Модель с одним изображением
     *
     * @return bool
     */
    public function isImageOne(): bool
    {
        $isClass = $this->attributes['imageable']->getRelated() instanceof \App\Models\Image\Image;
        $isObject = $this->attributes['imageable']->exists();

        return $isClass and $isObject;
    }

    /**
     * Если Модель имеет несколько изображений одного типа
     * @return bool
     */
    public function isImageMany()
    {
        return $this->attributes['imageable']->getRelated() instanceof \App\Models\Image\ImagesMany;
    }
}
