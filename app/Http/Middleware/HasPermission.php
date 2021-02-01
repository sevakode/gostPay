<?php

namespace App\Http\Middleware;

use App\Interfaces\OptionsPermissions;
use App\Notifications\DataNotification;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class HasPermission
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @param $permission
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        if($request->user()->hasPermissionTo($permission)) return $next($request);

        DataNotification::sendErrors(['У вас недостаточно прав!'], $request->user());

        return response()->view('pages.errors.error-1', [
            'code' => 500,
            'message' => 'У вас недостаточно прав!'
        ]);
    }
}
