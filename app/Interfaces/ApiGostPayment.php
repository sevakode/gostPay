<?php namespace App\Interfaces;



interface ApiGostPayment
{
    /** Возвращает коллекцию из данных апи в виде коллекции
     * @param $api
     * @return mixed
     */
    public static function getCollectApi($api): mixed;

    /** Заполняет/обновляет данные в модель
     * @return mixed
     */
    public static function refreshApi(): mixed;
}
