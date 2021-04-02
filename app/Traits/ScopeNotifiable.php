<?php namespace App\Traits;

use Illuminate\Support\Facades\DB;

/**
 * Trait ScopeNotifiable
 * @package App\Traits
 *
 * @method notifications()
 */
Trait ScopeNotifiable
{
    public function scopeNotifications($query)
    {
        $ids = array_column($query->select('id')->get()->toArray(), 'id');
        dd($ids);
        DB::table('notifications')->where('type', self::class)->whereIn('id', );
    }
}
