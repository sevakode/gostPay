<?php namespace App\Traits;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

/**
 * Trait ScopeNotifiable
 * @package App\Traits
 *
 * @method notifications()
 */
Trait ScopeNotifiable
{
    /**
     * @param $query
     * @return Builder
     */
    public function scopeNotifications($query): Builder
    {
        $ids = array_column($query->select('id')->get()->toArray(), 'id');
        return DB::table('notifications')->where('notifiable_type', self::class)->whereIn('notifiable_id', $ids);
    }

    public function scopeReadNotifications($query)
    {
        return $query->notifications()->whereNotNull('read_at');
    }

    public function scopeUnreadNotifications($query)
    {
        return $query->notifications()->whereNull('read_at');
    }
}
