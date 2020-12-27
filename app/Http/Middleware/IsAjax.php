<?php

namespace App\Http\Middleware;

use Closure;

use Illuminate\Http\Request;

class IsAjax
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(\Illuminate\Support\Facades\Request::ajax())
            return $next($request);
        return response()->view('pages.errors.error-1', [
            'code' => 500,
            'message' => 'Упс! Здесь что-то пошло не так'
        ]);
    }
}
