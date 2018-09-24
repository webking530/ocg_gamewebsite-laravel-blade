<?php

namespace Models\Auth;

use App\Models\Gaming\Badge;
use App\Models\Gaming\Game;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Models\Location\HasCountry;
use Models\Pricing\HasCurrency;

class User extends Authenticatable
{
    use Notifiable;
    use HasCurrency;
    use HasCountry;

    const ROLE_USER = 0;
    const ROLE_ADMIN = 1;

    const GENDER_MALE = 0;
    const GENDER_FEMALE = 1;

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

    public static function getGenderList() {
        return [
            self::GENDER_MALE => trans('app.user.gender.male'),
            self::GENDER_FEMALE => trans('app.user.gender.female')
        ];
    }

    public function referral() {
        return $this->belongsTo(User::class, 'referral_id');
    }

    public function badges() {
        return $this->belongsToMany(Badge::class, 'badge_user', 'user_id', 'badge_id')->orderBy('relevance', 'DESC');
    }

    public function gameSessions() {
        return $this->belongsToMany(Game::class, 'game_user_session', 'user_id', 'game_id')->withPivot(['credits']);
    }

    public function winnings() {
        return $this->belongsToMany(Game::class, 'game_user_winnings', 'user_id', 'game_id')->withPivot(['win_amount']);
    }

    public function isUser() {
        return (int)$this->role === self::ROLE_USER;
    }

    public function isAdmin() {
        return (int)$this->role === self::ROLE_ADMIN;
    }

    public function isMale() {
        return (int)$this->gender === self::GENDER_MALE;
    }

    public function getGenderIconAttribute() {
        if ((int)$this->gender === self::GENDER_MALE) {
            return 'fas fa-male';
        }

        return 'fas fa-female';
    }

    public function getGenderColorAttribute() {
        if ((int)$this->gender === self::GENDER_MALE) {
            return 'label-primary';
        }

        return 'label-pink';
    }

    public function getFlagIconAttribute() {
        return "img/flags/" . mb_strtolower($this->country_code) . ".png";
    }

    public function getFormattedAvatarAttribute() {
        if (empty($this->avatar_url)) {
            return $this->isMale() ? 'img/avatar/avatar_male.png' : 'img/avatar/avatar_female.png';
        }

        return $this->avatar_url;
    }

    public function getFullNameAttribute() {
        return "{$this->name} {$this->lastname}";
    }

    public function getCountryNameAttribute() {
        return country_name($this->country_code);
    }
}
