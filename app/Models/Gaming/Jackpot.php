<?php

namespace App\Models\Gaming;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;

class Jackpot extends Model
{
    use BelongsToAUser;

    protected $guarded = ['id'];

    const JACKPOT_SIZE_PERCENT = 0.01;
    const JACKPOT_CASINO_PERCENT = 0.5;

    public function getDaysSinceJackpotAttribute() {
        $days = $this->created_at->diffInDays(Carbon::now());
        $days = $days == 0 ? 1 : $days;

        return $days;
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

        $creditsInMachine = Game::enabled()->where('has_jackpot', true)->sum('credits');
        $latestJackpot = self::getLatestJackpot();

        $daysSinceJackpot = $latestJackpot == null ? $fakeJackpotDays : Carbon::now()->diffInDays($latestJackpot->created_at);
        $daysSinceJackpot = $daysSinceJackpot == 0 ? 1 : $daysSinceJackpot;


        return [
            'size' => $creditsInMachine * self::JACKPOT_CASINO_PERCENT * self::JACKPOT_SIZE_PERCENT,
            'days' => $daysSinceJackpot
        ];
    }

    public static function getHighestJackpot() {
        return self::orderBy('prize', 'DESC')->first();
    }

    public static function getLatestJackpot() {
        return self::latest()->first();
    }
}
