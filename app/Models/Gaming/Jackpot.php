<?php

namespace Models\Gaming;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;

class Jackpot extends Model
{
    use BelongsToAUser;

    protected $guarded = ['id'];

    const JACKPOT_COEFFICIENT = 0.01;
    const JACKPOT_MIN_BET_USD = 1;

    public function getDaysSinceJackpotAttribute() {
        $days = $this->created_at->diffInDays(Carbon::now());
        $days = $days == 0 ? 1 : $days;

        return $days;
    }

    public static function isRealJackpotEnabled() {
        return settings('enable_fake_jackpot') == 'false';
    }

    public static function getJackpotMinBet() {
        return self::JACKPOT_MIN_BET_USD;
    }

    public static function getJackpotCoefficient() {
        return self::JACKPOT_COEFFICIENT;
    }

    public static function getJackpotMinValue() {
        return (int)settings('jackpot_min_value');
    }

    public static function getJackpotMaxValue() {
        return (int)settings('jackpot_max_value');
    }

    public static function getRealJackpotValue() {
        return (float)settings('real_jackpot_current');
    }

    public static function getCurrentJackpot() {
        $enableFakeJackpot = settings('enable_fake_jackpot') == 'true';
        $fakeJackpotDays = Carbon::now()->diffInDays(Carbon::createFromDate(2018,9,1));

        if ($enableFakeJackpot) {
            return [
                'size' => (int)settings('fake_jackpot_current'),
                'days' => $fakeJackpotDays
            ];
        }

        //$creditsInMachines = Game::enabled()->where('has_jackpot', true)->sum('credits');
        $latestJackpot = self::getLatestJackpot();

        $daysSinceJackpot = $latestJackpot == null ? $fakeJackpotDays : Carbon::now()->diffInDays($latestJackpot->created_at);
        $daysSinceJackpot = $daysSinceJackpot == 0 ? 1 : $daysSinceJackpot;

        return [
            //'size' => $creditsInMachines * self::JACKPOT_CASINO_PERCENT * self::JACKPOT_SIZE_PERCENT,
            'size' => self::getRealJackpotValue(),
            'days' => $daysSinceJackpot
        ];
    }

    public static function getHighestJackpot() {
        return self::orderBy('prize', 'DESC')->first();
    }

    public static function getLatestJackpot() {
        return self::latest()->first();
    }

    // Due to rounding errors, earnings, loses and credit changes in machines that occur in real time,
    // we need to estimate if the amount provided (in a winning result) is close to the Jackpot. If it is,
    // we can assume that the user in fact hit the Jackpot.
    public static function amountIsCloseToJackpot($amount) {
        $currentJackpot = self::getCurrentJackpot()['size'];

        // The amount can get as close as 95% of the jackpot for us to assume that it was a jackpot winning
        $tolerance = 0.95;

        return $amount >= ($currentJackpot * $tolerance);
    }
}
