<?php

namespace App\Http\Middleware;

use App\Interfaces\OptionsPermissions;
use App\Notifications\DataNotification;
use Closure;
use Illuminate\Http\Request;

class HasDemo
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $demo = OptionsPermissions::DEMO['title'];
        if(!$request->user()->hasPermissionTo($demo)) return $next($request);

        DataNotification::sendErrors(['Вы используете '. $demo . ' версию!']);

        return response()->view('pages.errors.error-1', [
            'code' => 500,
            'message' => 'У вас недостаточно прав!'
        ]);
    }
}
