<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 21/09/18
 * Time: 01:56 PM
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->guest()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('login');
            }
        }

        if ( ! Auth::guard($guard)->user()->social_complete_register
        && ! in_array($request->route()->getName(), [
            'user.settings.index',
            'user.settings.store',
            'user.avatar.update',
            'user.settings.change_password'
        ])) {
            return redirect()->route('user.settings.index');
        }

        return $next($request);
    }
}