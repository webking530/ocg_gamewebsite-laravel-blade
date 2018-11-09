<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'register' => [
        'title' => 'Sign Up',
        'keywords' => 'register,sign up,create account',
        'description' => 'Sign Up now and start earning big prizes with our collection of engaging Casino Games',
    ],
    'login' => [
        'title' => 'Login',
        'keywords' => 'login,sign in',
        'description' => 'Login now and start earning big prizes with our collection of engaging Casino Games',

        'username_invalid' => 'The user to activate is invalid',
        'verification_pin_sent_sms' => 'A verification PIN was sent to you via SMS. It may take a few minutes to be received.',
        'verification_pin_sent_email' => 'A verification PIN was sent to you via email. It may take a few minutes to be received.',
        'account_suspended' => 'Your account was suspended due to violation to our Terms & Conditions',

        'verification_pin_invalid' => 'The verification pin you provided is invalid.',
        'verification_pin_invalid_minutes' => 'You must wait at least 10 minutes before requesting another pin',
        'verification_pin_invalid_send_error' => 'Could not send a verification pin at the moment. Try again later.',

        'account_activated' => 'Your account was successfully activated.'
    ],
    'activation' => [
        'title' => 'Activate your account',
        'keywords' => 'account,activation',
        'description' => 'Activate your account'
    ],
    'reset_password' => [
        'title' => 'Reset Password',
        'keywords' => 'reset,password',
        'description' => 'Did you forget your password? Request a new one here',
    ],
];
