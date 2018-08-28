<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class CheckAdministrator
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            return redirect()->guest('login');
        }

        if (Auth::guard($guard)->user()->isUser()) {
            return abort(404);
        }


        return $next($request);
    }
}
