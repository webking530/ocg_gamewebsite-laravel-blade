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
        // $usersByCountry = User::select('country_code', DB::raw('count(*) as users'))->groupBy('country_code')->get();
        $usersByCountry = \Models\Location\Country::with('user')->get();
        $lotteries = [
            'low_stake' => Lottery::whereType(Lottery::TYPE_LOW_STAKE)->where('status', Lottery::STATUS_PENDING)->first(),
            'mid_stake' => Lottery::whereType(Lottery::TYPE_MID_STAKE)->where('status', Lottery::STATUS_PENDING)->first(),
            'high_stake' => Lottery::whereType(Lottery::TYPE_HIGH_STAKE)->where('status', Lottery::STATUS_PENDING)->first()
        ];

        $paymentamount = [
            'approved' => Deposit::select(DB::raw('sum(amount_USD) as approved'))->where('status', Deposit::STATUS_APPROVED)->first(),
            'pendingapprovalWithdrawal' => Withdrawal::select(DB::raw('sum(amount_USD) as pendingapprovalWithdrawal'))->where('status', Withdrawal::STATUS_PENDING)->first(),
            'pendingapprovalDeposit' => Deposit::select(DB::raw('sum(amount_USD) as pendingapprovalDeposit'))->where('status', Deposit::STATUS_PENDING)->first(),
            'withdrawn' => Withdrawal::select(DB::raw('sum(amount_USD) as withdrawn'))->where('status', Withdrawal::STATUS_APPROVED)->first(),
            'lastTenApprovedDepositPayments' => Deposit::with('user')->where('status', Deposit::STATUS_APPROVED)->orderBy('approved_at', 'DESC')->get()->take(5),
            'lastTenApprovedWithdrawalPayments' => Withdrawal::with('user')->where('status', Withdrawal::STATUS_APPROVED)->orderBy('updated_at', 'DESC')->get()->take(5)
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

    public function filterpayments(Request $request) {
        $from = $request->get('from');
        $to = $request->get('to');

        $approved = Deposit::select(DB::raw('sum(amount_USD) as approved'))->where('status', Deposit::STATUS_APPROVED);
        $withdrawn = Withdrawal::select(DB::raw('sum(amount_USD) as withdrawn'))->where('status', Withdrawal::STATUS_APPROVED);
        $pendingapprovalWithdrawal = Withdrawal::select(DB::raw('sum(amount_USD) as pendingapprovalWithdrawal'))->where('status', Withdrawal::STATUS_PENDING);
        $pendingapprovalDeposit = Deposit::select(DB::raw('sum(amount_USD) as pendingapprovalDeposit'))->where('status', Deposit::STATUS_PENDING);

        if ($request->get('label') != 'All Time') {
            $approved->whereBetween('approved_at', [$from, $to]);
            $withdrawn->whereBetween('updated_at', [$from, $to]);
            $pendingapprovalWithdrawal->whereBetween('created_at', [$from, $to]);
            $pendingapprovalDeposit->whereBetween('created_at', [$from, $to]);
        }

        $paymentamount = [
            'approved' => $approved->first(),
            'withdrawn' => $withdrawn->first(),
            'pendingapprovalWithdrawal' => $pendingapprovalWithdrawal->first(),
            'pendingapprovalDeposit' => $pendingapprovalDeposit->first(),
        ];
        return $paymentamount;
    }

}
