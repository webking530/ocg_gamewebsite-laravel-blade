<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use JavaScript;
use Models\Auth\User;
use Models\Notifier\FlashNotifier;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var User $user
     */
    protected $user = null;
    protected $guard = null;
    protected $flashNotifier;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->user = Auth::check() ? \Auth::user() : null;
        $this->flashNotifier = new FlashNotifier();

        $this->middleware(function ($request, $next) {
            $this->guard = $this->guard ?: $this->guessGuard();

            $loggedIn = Auth::guard($this->guard)->check();


            if ($loggedIn) {
                $user_id = Auth::guard($this->guard)->id();
                $this->user = Auth::guard($this->guard)->user()->findOrFail($user_id);
            }

            JavaScript::put([
                'confirmYes' => trans('app.common.confirm_text'),
                'confirmNo' => trans('app.common.cancel_text'),
                'confirmTitle' => trans('app.common.are_you_sure'),
                'confirmContent' => trans('app.common.action_cannot_undone')
            ]);

            return $next($request);
        });
    }

    private function guessGuard()
    {
        foreach (array_keys(config('auth.guards')) as $guard) {
            if (Auth::guard($guard)->check()) {
                return $guard;
            }
        }

        return config('auth.defaults.guard');
    }
}
