<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Models\Bonuses\Bonus;
use Models\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

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
}
