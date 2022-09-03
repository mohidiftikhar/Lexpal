<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CustomMiddleware
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

        $link   =   $request->server('HTTP_REFERER');
        if (!empty($link)){
            return $next($request);
        }
        return abort('403');
    }
}
