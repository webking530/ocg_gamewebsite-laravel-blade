<?php

namespace Models\Auth;

use DB;
use Models\Gaming\Badge;
use Models\Gaming\Game;
use Models\Gaming\Lottery;
use Models\Location\HasCountry;
use Models\Location\HasLanguage;
use Models\Pricing\HasCurrency;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasCurrency;
    use HasCountry;
    use HasLanguage;

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
        return $this->belongsToMany(Badge::class, 'badge_user', 'user_id', 'badge_id')->orderBy('relevance', 'DESC')->withPivot(['created_at']);
    }

    public function gameSessions() {
        return $this->belongsToMany(Game::class, 'game_user_session', 'user_id', 'game_id')->withPivot(['credits', 'token', 'created_at', 'updated_at']);
    }

    public function scopeUsers($query) {
        return $query->where('role', self::ROLE_USER);
    }

    public function scopeEnabled($query) {
        return $query->whereNull('verification_pin');
    }

    public function scopeVerified($query) {
        return $query->where('verified_identification', true);
    }

    public function scopeHasCredits($query) {
        return $query->where('credits', '>', 0);
    }

    public function gameSessionsCreditSum() {
        $sum = 0;

        foreach ($this->gameSessions as $game) {
            $sum += $game->pivot->credits;
        }

        return $sum;
    }

    public function betsOpen() {
        return $this->belongsToMany(Game::class, 'game_user_bets_open', 'user_id', 'game_id')->withPivot(['bet_amount']);
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

    public function getTotalWinningCredits() {
        $credits = 0;

        foreach ($this->winnings as $winning) {
            $credits += $winning->pivot->win_amount;
        }

        return $credits;
    }

    public function getRankingNumber() {
        $query = DB::select("
        SELECT * FROM (
            SELECT @i := @i + 1 AS ranking, id AS user_id
            FROM
            (
                SELECT id, t.total FROM users
                LEFT JOIN (
                    SELECT 
                    user_id, 
                    SUM(win_amount) total           
                    FROM game_user_winnings      
                    GROUP BY user_id
                ) AS t
                ON users.id = t.user_id
                WHERE users.id IS NOT NULL
                ORDER BY total DESC
            ) AS t,
            (SELECT @i := 0) AS temp
        ) AS r
        WHERE r.user_id = {$this->id}
        ");


        return $query[0]->ranking;
    }

    public function closeGameSession(Game $game) {
        $credits = $this->gameSessions()->where('game_id', $game->id)->first()->pivot->credits;

        DB::beginTransaction();

        $this->credits += $credits;
        $this->save();

        $this->gameSessions()->detach($game->id);

        DB::commit();
    }

    public function closeAllGameSessions() {
        $credits = 0;

        foreach ($this->gameSessions as $game) {
            $credits += $game->pivot->credits;
        }

        DB::beginTransaction();

        $this->credits += $credits;
        $this->save();

        $this->gameSessions()->detach();

        DB::commit();
    }

    public function isLowOnBalance() {
        if ($this->low_balance_threshold <= 0) {
            return false;
        }

        return $this->credits <= $this->low_balance_threshold;
    }

    public function getBoughtLotteryTickets(Lottery $lottery) {
        return $lottery->tickets()->where('user_id', $this->id)->get();
    }

    public function isParticipatingInLottery(Lottery $lottery) {
        return $lottery->tickets()->where('user_id', $this->id)->count() > 0;
    }

    public function getOpenSession(Game $game) {
        return $this->gameSessions()->where('game_id', $game->id)->first();
    }
}
