<?php namespace App\Interfaces;


use \Illuminate\Support\Collection;

interface ApiGostPayment
{
    /** Возвращает коллекцию из данных апи в виде коллекции
     * @param $api
     * @return Collection|array
     */
    public static function getCollectApi($api): Collection|array;

    /** Заполняет/обновляет данные в модель
     * @return mixed
     */
    public static function refreshApi(): mixed;
}
