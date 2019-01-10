<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Models\Auth\User;
use \Illuminate\Http\Request;
use Models\Mailing\ActivationEmail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/account/dashboard';

    const RESEND_PIN_MINUTES_RETRY = 10;
    const ACTIVATION_PIN_SMS = 'sms';
    const ACTIVATION_PIN_EMAIL = 'email';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $enableSocial = settings('enable_social_register') == 'true';

        return view('auth.login', compact('enableSocial'));
    }

    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }


        $credentials = $this->credentials($request);

        /**
         * @var User $user
         */
        $user = User::where('email', $credentials['email'])->first();

        if ($user != null && $user->verification_pin != null) {
            if ($this->canSendPin($user)) {
                try {
                    $this->sendSMSPin($user);

                    $user->verification_pin_sent_at = Carbon::now();
                    $user->save();
                } catch (\Exception $exception) {
                    $this->flashNotifier->error(trans('auth.login.verification_pin_invalid_send_error'));

                    return redirect()->route('home.activation', ['nickname' => $user->nickname]);
                }
            }

            return redirect()->route('home.activation', ['nickname' => $user->nickname]);
        }

        if ($user->isSuspended()) {
            $this->flashNotifier->error(trans('auth.login.account_suspended'));

            return redirect()->route('home.login');
        }


        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    public function redirectPath() {
        if ($this->guard()->user()->isUser()) {
             return route('user.dashboard.index');
        } else {
            return route('admin.home');
        }
    }


    public function activationForm($nickname) {
        $user = User::where('nickname', $nickname)->whereNotNull('verification_pin')->first();

        if ($user == null || $user->verification_pin == null) {
            $this->flashNotifier->error(trans('auth.login.username_invalid'));

            return redirect()->route('home.login');
        } else {
            if ($this->canSendPin($user)) {
                try {
                    $this->sendSMSPin($user);

                    $user->verification_pin_sent_at = Carbon::now();
                    $user->save();
                } catch (\Exception $exception) {
                    $this->flashNotifier->error(trans('auth.login.verification_pin_invalid_send_error'));

                    return view('auth.activation', compact('user'));
                }
            }
        }

        return view('auth.activation', compact('user'));
    }

    public function activationPost(Request $request, User $user) {
        if ($request->get('verification_pin') != $user->verification_pin) {
            $this->flashNotifier->error(trans('auth.login.verification_pin_invalid'));

            return redirect()->back();
        }

        $user->verification_pin = null;
        $user->save();

        //EmailsHelper::sendWelcomeEmail($user);

        Auth::login($user);

        $this->flashNotifier->success(trans('auth.login.account_activated'));

        return redirect()->route('user.dashboard.index');
    }

    /**
     * @param User $user
     * @param $type (email|sms)
     * @return \Illuminate\Http\RedirectResponse
     */
    public function resendPin(User $user, $type) {
        if ($user->verification_pin == null) {
            return redirect()->route('home.login');
        }

        if ( ! $this->canSendPin($user)) {
            $this->flashNotifier->error(trans('auth.login.verification_pin_invalid_minutes'));

            return redirect()->route('home.activation', ['nickname' => $user->nickname]);
        }

        try {
            $this->sendActivationPin($user, $type);

            $user->verification_pin_sent_at = Carbon::now();
            $user->save();
        } catch (\Exception $exception) {
            $this->flashNotifier->error(trans('auth.login.verification_pin_invalid_send_error'));

            return redirect()->route('home.activation', ['nickname' => $user->nickname]);
        }

        $this->flashNotifier->success(trans("auth.login.verification_pin_sent_{$type}"));

        return redirect()->route('home.activation', ['nickname' => $user->nickname]);
    }

    private function canSendPin(User $user) {
        return $user->verification_pin_sent_at == null || $user->verification_pin_sent_at->diffInMinutes(Carbon::now()) >= self::RESEND_PIN_MINUTES_RETRY;
    }

    /**
     * @param User $user
     * @param $type
     * @throws \Exception
     */
    private function sendActivationPin(User $user, $type) {
        return $type == self::ACTIVATION_PIN_SMS ? $this->sendSMSPin($user) : $this->sendEmailPin($user);
    }

    private function sendSMSPin(User $user) {
        // TODO: implement
    }

    /**
     * @param User $user
     * @throws \Exception
     */
    private function sendEmailPin(User $user) {
        (new ActivationEmail($user->email, ['user' => $user]))->send();
    }
}
