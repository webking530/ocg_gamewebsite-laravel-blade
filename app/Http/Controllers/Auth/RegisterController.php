<?php

namespace App\Http\Controllers\Auth;

use Google_Client;
use Illuminate\Auth\Events\Registered;
use Models\Bonuses\Bonus;
use Models\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Models\Location\Country;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, User::registerRules());
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param Request $request
     * @param  array  $data
     * @return User
     */
    protected function create(Request $request, array $data)
    {
        $user = new User();

        $user->nickname = $data['nickname'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);
        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->gender = $data['gender'];
        $user->mobile_number = $data['mobile_number'];
        $user->country_code = $data['country_code'];
        $user->currency_code = $data['currency_code'];
        $user->credits = 0;
        $user->birthdate = $data['birthdate'];
        $user->verification_pin = mt_rand(100000, 999999);
        $user->low_balance_threshold = 0;
        $user->referrer_id = $this->getReferrer($request);
        $user->role = User::ROLE_USER;
        $user->locale = \App::getLocale();
        $user->verified_identification = false;
        $user->notifications = 1;
        $user->lottery_sms_notification_minutes = 0;
        $user->social_complete_register = true;

        if (isset($data['avatar_url'])) {
            $user->avatar_url = $data['avatar_url'];
        }

        $user->save();

        return $user;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request, $request->all())));

        return $this->registered($request, $user)
            ?: redirect()->route('home.activation', ['nickname' => $user->nickname]);
    }

    public function showRegistrationForm()
    {
        $enableSocial = settings('enable_social_register') == 'true';
        $welcomeBonus = Bonus::whereSlug(Bonus::SLUG_WELCOME)->first();

        return view('auth.register', compact('welcomeBonus', 'enableSocial'));
    }

    private function getReferrer(Request $request) {
        if ($request->has('dcp')) {
            $referrerNickname = trim($request->get('dcp'));
        } elseif ($request->hasCookie('dcp')) {
            $referrerNickname = trim($request->cookie('dcp'));
        } else {
            return null;
        }

        return User::where('dcp_suspended', 0)->where('nickname', $referrerNickname)->first()->id;
    }

    public function authFromGoogle(Request $request) {
        $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
        $payload = $client->verifyIdToken($request->get('token'));
        if ($payload) {
            $userid = $payload['sub'];

            $user = User::where('google_auth_id', $userid)->first();

            if ($user != null) {
                $this->guard()->login($user);

                return [
                    'status' => 'success',
                    'route' => route('user.dashboard.index'),
                ];
            }
        } else {
            return [
                'status' => 'error',
                'msg' => 'Invalid session token',
                'route' => route('home.login'),
            ];
        }

        if (User::where('email', $payload['email'])->first() != null) {
            return [
                'status' => 'error',
                'msg' => 'An account with this email address is already registered.',
                'route' => route('home.login'),
            ];
        }

        $data = [
            'nickname' => explode('@', $request->get('email'))[0] . '_' . mt_rand(1, 10),
            'email' => $request->get('email'),
            'password' => null,
            'name' => $request->get('name'),
            'lastname' => $request->get('lastname'),
            'gender' => User::GENDER_MALE,
            'mobile_number' => 0,
            'country_code' => Country::getDefaultCountryCode(),
            'currency_code' => 'USD',
            'birthdate' => null,
            'avatar_url' => $request->get('avatar_url'),
        ];

        $user = $this->create($request, $data);

        $user->google_auth_id = $userid;
        $user->google_auth_token = $request->get('token');
        $user->social_complete_register = false;
        $user->verification_pin = null;
        $user->save();

        $this->guard()->login($user);

        return [
            'status' => 'success',
            'route' => route('user.dashboard.index'),
        ];
    }
}
