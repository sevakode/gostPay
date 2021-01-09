<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasRole
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
        if($request->user()->hasRole($permission)) return $next($request);
        return response()->view('pages.errors.error-1', [
            'code' => 500,
            'message' => 'У вас недостаточно прав!'
        ]);
    }
}
