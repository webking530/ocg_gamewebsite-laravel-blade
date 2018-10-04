<?php

namespace App\Http\Controllers\Account;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\Gaming\Lottery;
use Models\Gaming\LotteryTicket;

class LotteryController extends Controller
{
    public function buyTickets(Lottery $lottery) {
        // Reset reservations on new page load
        $lottery->tickets()->where('reserver_id', $this->user->id)->update([
            'reserver_id' => null,
            'reserved_at' => null
        ]);

        return view('user.lottery.buy_tickets', compact('lottery'));
    }

    public function reserveTicket(Request $request) {
        $ticket = LotteryTicket::find($request->get('ticket_id'));
        $action = $request->get('action'); // add_reserve / remove_reserve

        if ($action == 'add_reserve') {
            if ($ticket->isAvailable()) {
                $reservations = LotteryTicket::where('lottery_id', $ticket->lottery_id)->where('reserver_id', $this->user->id)->count();

                if ($reservations >= LotteryTicket::MAX_USER_RESERVATIONS) {
                    return [
                        'status' => false,
                        'msg' => trans('frontend/lottery.buy_tickets.max_reservations', ['max' => LotteryTicket::MAX_USER_RESERVATIONS])
                    ];
                }

                $ticket->reserver_id = $this->user->id;
                $ticket->reserved_at = Carbon::now();
                $ticket->save();

                return [
                    'status' => true,
                    'msg' => null
                ];
            } else {
                return [
                    'status' => false,
                    'msg' => trans('frontend/lottery.buy_tickets.ticket_taken')
                ];
            }
        } else { // Remove reserve
            if ($ticket->isReservedBy($this->user)) {
                $ticket->reserver_id = null;
                $ticket->reserved_at = null;
                $ticket->save();

                return [
                    'status' => true,
                    'msg' => null
                ];
            } else {
                return [
                    'status' => false,
                    'msg' => trans('frontend/lottery.buy_tickets.ticket_taken')
                ];
            }
        }
    }

    public function checkTicketReservation(Lottery $lottery) {
        return $lottery->tickets()->where('reserver_id', '!=', $this->user->id)->pluck('id')->all();
    }
}
