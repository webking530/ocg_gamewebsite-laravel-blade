<?php

namespace App\Http\Controllers;

use App\Models\Gaming\Lottery;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    public function index() {
        $lowStake = Lottery::whereType(Lottery::TYPE_LOW_STAKE)->whereIn('status', [Lottery::STATUS_ACTIVE, Lottery::STATUS_PENDING])->first();
        $midStake = Lottery::whereType(Lottery::TYPE_MID_STAKE)->whereIn('status', [Lottery::STATUS_ACTIVE, Lottery::STATUS_PENDING])->first();
        $highStake = Lottery::whereType(Lottery::TYPE_HIGH_STAKE)->whereIn('status', [Lottery::STATUS_ACTIVE, Lottery::STATUS_PENDING])->first();

        $lotteries = [
            'low_stake' => $lowStake,
            'mid_stake' => $midStake,
            'high_stake' => $highStake
        ];

        return view('frontend.lottery', compact('lotteries'));
    }

    public function getCountdown(Request $request) {
        $lottery = Lottery::find($request->get('lottery_id'));

        $countdown = $lottery->getBeginCountdown();

        return [
            'started' => $countdown['started'],
            'text' => $countdown['text']
        ];
    }

    public function getTabContent(Request $request) {
        $lottery = Lottery::find($request->get('lottery_id'));
        $status = (int)$request->get('status');

        if ((int)$lottery->status == $status) {
            return [
                'status_updated' => false
            ];
        }

        return [
            'status_updated' => true,
            'status' => $lottery->status,
            'html' => view('frontend.partials.lottery_tab_content', compact('lottery'))->render()
        ];
    }

    public function watch(Lottery $lottery) {
        $winningNumber = json_encode($lottery->getWinningTicket()->formatted_numbers_for_game);

        return view('frontend.lottery.game', compact('winningNumber'));
    }
}
