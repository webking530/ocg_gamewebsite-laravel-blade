<?php

namespace App\Http\Middleware;

use Closure;

class ReferrerCookies
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->has('dcp')) {
            $response = $next($request)->withCookie(cookie('dcp', $request->input('dcp'), 24 * 60 * 3));
        } else {
            $response = $next($request);
        }

        return $response;
    }
}
