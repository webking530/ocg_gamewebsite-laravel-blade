<?php

namespace Models\Auth;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Models\Location\HasCountry;
use Models\Pricing\HasCurrency;

class User extends Authenticatable
{
    use Notifiable;
    use HasCurrency;
    use HasCountry;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'birthdate'
    ];

    public function referral() {
        return $this->belongsTo(User::class, 'referral_id');
    }

    public function isUser() {
        return false; // TODO: check user role
    }
}
