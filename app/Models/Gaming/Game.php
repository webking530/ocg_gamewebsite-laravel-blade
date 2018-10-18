<?php

namespace Models\Gaming;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Models\Auth\User;

class Game extends Model
{
    protected $guarded = ['id'];

    const TYPE_NORMAL = 0;
    const TYPE_INSTANT_WIN = 1;

    const GROUP_SLOT = 0;
    const GROUP_ROULETTE = 1;
    const GROUP_CARD = 2;
    const GROUP_BINGO = 3;
    const GROUP_OTHER = 4;

    const GROUP_LIST = [
        self::GROUP_SLOT,
        self::GROUP_ROULETTE,
        self::GROUP_CARD,
        self::GROUP_BINGO,
        self::GROUP_OTHER
    ];

    const POPULAR_GAMES_AMOUNT = 8;

    public function winnings() {
        return $this->belongsToMany(User::class, 'game_user_winnings', 'game_id', 'user_id')->withPivot(['win_amount']);
    }

    public function getNameAttribute() {
        return trans('games.name.' . $this->id);
    }

    public function getFormattedTypeAttribute() {
        return trans('games.type.' . $this->type);
    }

    public function getFormattedGroupAttribute() {
        return trans('games.group.' . $this->group);
    }

    public function getSmallIconAttribute() {
        return "img/games/icons/{$this->id}.png";
    }

    public function scopeEnabled($query) {
        return $query->where('enabled', true);
    }

    public function isInstantWin() {
        return $this->type === self::TYPE_INSTANT_WIN;
    }

    public function isPopular() {
        $populars = self::enabled()->orderBy('sessions_opened', 'DESC')->take(self::POPULAR_GAMES_AMOUNT)->pluck('id')->all();

        return in_array($this->id, $populars);
    }

    public function getDynamicSettings() {
        $settings = json_decode($this->settings);

        $userCashKey = $settings->user_cash_key;
        $gameCashKey = $settings->game_cash_key;

        $userSession = Auth::user()->gameSessions()->where('game_id', $this->id)->first();

        $userCash = $userSession === null ? 0.0 : (float)$userSession->pivot->credits;
        $gameCash = (float)$this->credits;

        $settings->live->{$userCashKey} = $userCash;
        $settings->live->{$gameCashKey} = $gameCash;

        return json_encode($settings->live);
    }

    public function addCredits($credits) {
        $this->credits += $credits;
        $this->save();
    }

    public function subCredits($credits) {
        $this->credits -= $credits;
        $this->save();
    }
}
