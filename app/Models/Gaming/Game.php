<?php

namespace Models\Gaming;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Models\Auth\User;

class Game extends Model {

    protected $guarded = ['id'];

    protected $casts = [
        'settings' => 'array'
    ];

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
        return $this->belongsToMany(User::class, 'game_user_winnings', 'game_id', 'user_id')->withPivot(['win_amount', 'lose_amount', 'token']);
    }

    public function sessions() {
        return $this->belongsToMany(User::class, 'game_user_session', 'game_id', 'user_id');
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

        $userCash = $userSession === null ? 0.0 : (float) $userSession->pivot->credits;
        $gameCash = (float) $this->credits;

        $settings->live->{$userCashKey} = $userCash;
        $settings->live->{$gameCashKey} = $gameCash;

        /*
          We need to dynamically adjust the multiplier value for the highest value figure in
          each slot game. It will be based around the Jackpot size, so the higher the Jackpot, the
          higher the multiplier.
          Each game has a max coin interval that will be multiplied by the number of lines the game has. That is
          the basic formula to get the max possible bet the user can place.
         */
        if ($this->has_jackpot && Jackpot::isRealJackpotEnabled()) {
            $jackpot = Jackpot::getCurrentJackpot()['size'];

            switch ($this->slug) {
                default:
                case 'slot-machine-the-fruits':
                case 'slot-machine-ultimate-soccer':
                    $max_bet = 0.5 * 20;
                    break;
                case 'slot-machine-mr-chicken':
                case 'slot-machine-space-adventure':
                case 'slot-machine-ramses-treasure':
                case 'slot-machine-lucky-christmas':
                    $max_bet = $settings->live->max_bet * 5;
                    break;
                case 'slot-machine-arabian-nights':
                    $max_bet = last($settings->live->coin_bet) * 20;
                    break;
            }

            $settings->live->paytable_symbol_1[count($settings->live->paytable_symbol_1) - 1] = ceil($jackpot / $max_bet);
        }

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

    public function getSettingsDecodedAttribute() {
        return json_decode($this->settings)->live;
    }

    public function getHighestWinAmount(Game $game) {
        $winning = $this->winnings()->where('game_id', $game->id)->orderBy('pivot_win_amount', 'DESC')->first();

        if ($winning == null) {
            return 0;
        }

        return $winning->pivot->win_amount;
    }

    public function getLastWinAmount(Game $game) {
        $winning = $this->winnings()->where('game_id', $game->id)->orderBy('created_at', 'DESC')->first();

        if ($winning == null) {
            return 0;
        }

        return $winning->pivot->win_amount;
    }

    public function getDepositedAmount(Game $game) {
        $Amount = $this->sessions()->where('game_id', $game->id)->sum('game_user_session.credits');
        if ($Amount == null) {
            return 0;
        }
        return $Amount;
    }

    public function getWinningUser(Game $game) {
        $winning = $this->winnings()->where('game_id', $game->id)->orderBy('pivot_win_amount', 'DESC')->first();

        if ($winning == null) {
            return '';
        }
        return $winning->nickname;
    }

}
