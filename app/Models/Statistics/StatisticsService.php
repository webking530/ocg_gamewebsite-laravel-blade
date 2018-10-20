<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 20/09/18
 * Time: 07:24 PM
 */

namespace Models\Statistics;


use Models\Gaming\Game;
use Models\Gaming\Jackpot;
use Models\Gaming\Lottery;
use Models\Pricing\Withdrawal;
use Models\Auth\User;

class StatisticsService
{
    private $fakeStats;

    public function __construct()
    {
       $this->fakeStats = settings('enable_fake_statistics') == 'true';
    }

    public function getGamesAmount() {
        return Game::count() + 1; // Lottery is counted as extra, since it is not in the Game table
    }

    public function getUsersAmount() {
        if ($this->fakeStats) {
            return (int)settings('fake_users_amount');
        }

        return User::count();
    }

    public function getMoneyPaid() {
        if ($this->fakeStats) {
            return (int)settings('fake_money_paid');
        }

        return Withdrawal::whereStatus(Withdrawal::STATUS_APPROVED)->sum('amount');
    }

    public function getHighestLotteryPot() {
        if ($this->fakeStats) {
            return (int)settings('fake_highest_lottery_pot');
        }

        return Lottery::whereStatus(Lottery::STATUS_FINALIZED)->orderBy('prize', 'DESC')->first()->prize;
    }
}