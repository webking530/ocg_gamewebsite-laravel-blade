<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Models\Gaming\Game;
use Models\Gaming\GameUserWinning;
use Models\Auth\User;
use Models\Pricing\Deposit;
use Models\Pricing\Withdrawal;
use Models\Gaming\Lottery;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller {

    public function index() {
        $games = Game::get();
        $mostPlayedGame = Game::orderBy('sessions_opened', 'desc')->first();

        $topUserByCreditsEarned = GameUserWinning::with('user')
                        ->orderBy('win_amount', 'DESC')
                        ->groupBy(['user_id'])
                        ->take(10)->get();
        $topUserByMoneyDeposited = Deposit::with('user')
                        ->orderBy('amount', 'DESC')
                        ->groupBy(['user_id'])
                        ->take(10)->get();
        $topUserByMoneyWithdrawn = Withdrawal::with('user')
                        ->orderBy('amount', 'DESC')
                        ->groupBy(['user_id'])
                        ->take(10)->get();
        $unverifiedUsers = User::where('verification_pin', '!=', '')->get();
        $sudpendedUsers = User::where('suspended_on', '!=', '')->get();
        $gender = User::select('gender', DB::raw('count(*) *100 / (select count(*) from users) as percentage'))->groupBy('gender')->get();
        foreach ($gender as $gen) {
            if ($gen->gender == User::GENDER_MALE) {
                $gender->male = (int) $gen['percentage'];
            } else {
                $gender->female = (int) $gen['percentage'];
            }
        }
        $usersByCountry = User::select('country_code', DB::raw('count(*) as users'))->groupBy('country_code')->get();

        $lotteries = [
            'low_stake' => Lottery::whereType(Lottery::TYPE_LOW_STAKE)->where('status', Lottery::STATUS_PENDING)->first(),
            'mid_stake' => Lottery::whereType(Lottery::TYPE_MID_STAKE)->where('status', Lottery::STATUS_PENDING)->first(),
            'high_stake' => Lottery::whereType(Lottery::TYPE_HIGH_STAKE)->where('status', Lottery::STATUS_PENDING)->first()
        ];

        $paymentamount = [
            'approved' => Deposit::select(DB::raw('sum(amount_USD) as approved'))->where('status', Deposit::STATUS_APPROVED)->first(),
            'pendingapproval' => Deposit::select(DB::raw('sum(amount_USD) as pendingapproval'))->where('status', Deposit::STATUS_PENDING)->first(),
            'withdrawn' => Withdrawal::select(DB::raw('sum(amount_USD) as withdrawn'))->where('status', Deposit::STATUS_APPROVED)->first(),
            'lastTenApprovedPayments' => Deposit::with('user')->where('status', Deposit::STATUS_APPROVED)->orderBy('approved_at', 'DESC')->get()->take(10),
        ];
        return view('admin.home'
                , compact(
                        'games'
                        , 'mostPlayedGame'
                        , 'topUserByCreditsEarned'
                        , 'topUserByMoneyDeposited'
                        , 'unverifiedUsers'
                        , 'sudpendedUsers'
                        , 'gender'
                        , 'usersByCountry'
                        , 'lotteries'
                        , 'paymentamount'
        ));
    }

}
