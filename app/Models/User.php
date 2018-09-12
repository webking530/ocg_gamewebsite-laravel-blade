<?php

namespace App\Models;

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

   protected $table='users';
    protected $guarded = ['id'];
    protected $fillable = ['name', 'email','nickname','lastname','gender','mobile_number',
    'avatar_url','credits','country_code','currency_code','verification_pin','low_balance_threshold',
    'role','locale','verified_identification','notifications','lottery_sms_notification_minutes',
    'password'];

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
    public function depositBelongsTo(){
      return  $this->belongsTo('App\Models\Pricing\Deposits','user_id');

    }
    public function withdrawnBelongsTo(){
        return $this->belongsTo('App\Models\Pricing\Withdrawal ','user_id');
    }
}
