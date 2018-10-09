<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Models\Gaming\Lottery;
use Illuminate\Http\Request;

class LotteryController extends Controller
{
    public function index() {
        $lotteries = [
            'low_stake' => Lottery::whereType(Lottery::TYPE_LOW_STAKE)->whereIn('status', [Lottery::STATUS_ACTIVE, Lottery::STATUS_PENDING])->first(),
            'mid_stake' => Lottery::whereType(Lottery::TYPE_MID_STAKE)->whereIn('status', [Lottery::STATUS_ACTIVE, Lottery::STATUS_PENDING])->first(),
            'high_stake' => Lottery::whereType(Lottery::TYPE_HIGH_STAKE)->whereIn('status', [Lottery::STATUS_ACTIVE, Lottery::STATUS_PENDING])->first()
        ];

        $sevenDaysAgo = Carbon::now()->subDays(7);
        $cancelledLotteries = [
            'low_stake' => Lottery::whereType(Lottery::TYPE_LOW_STAKE)->cancelled()->where('updated_at', '>=', $sevenDaysAgo)->orderBy('updated_at', 'DESC')->first(),
            'mid_stake' => Lottery::whereType(Lottery::TYPE_MID_STAKE)->cancelled()->where('updated_at', '>=', $sevenDaysAgo)->orderBy('updated_at', 'DESC')->first(),
            'high_stake' => Lottery::whereType(Lottery::TYPE_HIGH_STAKE)->cancelled()->where('updated_at', '>=', $sevenDaysAgo)->orderBy('updated_at', 'DESC')->first(),
        ];

        $lowStakeLatest = Lottery::getLatestWin(Lottery::TYPE_LOW_STAKE);
        $lowStakeHighest = Lottery::getHighestWin(Lottery::TYPE_LOW_STAKE);

        $midStakeLatest = Lottery::getLatestWin(Lottery::TYPE_MID_STAKE);
        $midStakeHighest = Lottery::getHighestWin(Lottery::TYPE_MID_STAKE);

        $highStakeLatest = Lottery::getLatestWin(Lottery::TYPE_HIGH_STAKE);
        $highStakeHighest = Lottery::getHighestWin(Lottery::TYPE_HIGH_STAKE);

        return view('frontend.lottery', compact(
            'lotteries',
            'cancelledLotteries',
            'lowStakeLatest',
            'lowStakeHighest',
            'midStakeLatest',
            'midStakeHighest',
            'highStakeLatest',
            'highStakeHighest'
        ));
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
        $winningTicket = $lottery->getWinningTicket();

        $winningTicketNumbers = json_encode($winningTicket->formatted_numbers_for_game);
        $prize = $lottery->getPotSize();

        if ($winningTicket->user_id == $this->user->id) {
            // No matter if the user bought multiple tickets, we will only compare with the winning one
            $userTicketNumbers = $winningTicketNumbers;
        } else {
            // This user is not a winner, so there's no point in comparing with all tickets.
            // Just compare with the first one
            $userTicketNumbers = json_encode($lottery->tickets()->where('user_id', $this->user->id)->first()->formatted_numbers_for_game);
        }

        return view('frontend.lottery.game', compact('winningTicketNumbers', 'prize', 'userTicketNumbers'));
    }
}
