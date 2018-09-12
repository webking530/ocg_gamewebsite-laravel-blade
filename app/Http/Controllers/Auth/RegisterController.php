<?php

namespace App\Http\Controllers\Auth;

use Models\Auth\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'nickname' => $data['nickname'],
            'lastname' => $data['lastname'],
            'gender' => $data['gender'],
            'mobile_number' => $data['mobile_number'],
            'avatar_url' => $data['avatar_url'],
            'credits' => $data['credits'],
            'country_code' => $data['country_code'],
            'currency_code' => $data['currency_code'],
            'verification_pin' => $data['verification_pin'],
            'low_balance_threshold' => $data['low_balance_threshold'],
            'role' => $data['role'],
            'locale' => $data['locale'],
            'verified_identification' => $data['verified_identification'],
            'notifications' => $data['notifications'],
             'lottery_sms_notification_minutes' => $data['lottery_sms_notification_minutes'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
