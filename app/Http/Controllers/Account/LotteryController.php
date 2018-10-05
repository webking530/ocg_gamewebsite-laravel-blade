<?php

namespace App\Http\Controllers\Account;

use Carbon\Carbon;
use DB;
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

    public function buyTicketsPost(Request $request, Lottery $lottery) {
        $tickets = $request->get('tickets');

        if (count($tickets) <= 0) {
            $this->flashNotifier->error(trans('frontend/lottery.buy_tickets.must_select_to_buy'));

            return redirect()->back();
        }

        $availableToBuy = $lottery->tickets()->whereIn('id', $tickets)->where(function($q) {
            $q->whereNotNull('user_id')->orWhere('reserver_id', '!=', $this->user->id)->orWhereNull('reserver_id');
        })->count() == 0;

        if ( ! $availableToBuy) {
            $this->flashNotifier->error(trans('frontend/lottery.buy_tickets.one_selected_ticket_not_available'));

            return redirect()->back();
        }


        $totalPrice = $lottery->ticket_price * count($tickets);

        if ($this->user->credits < $totalPrice) {
            $this->flashNotifier->error(trans('app.not_enough_credits'));

            return redirect()->back();
        }

        DB::beginTransaction();

        $this->user->credits -= $totalPrice;
        $this->user->save();

        $lottery->tickets()->whereIn('id', $tickets)->update([
            'user_id' => $this->user->id
        ]);

        DB::commit();

        $this->flashNotifier->success(trans('app.common.operation_success'));

        return redirect()->route('user.lottery.my_tickets', ['lottery' => $lottery]);
    }

    public function myTickets(Lottery $lottery) {
        $myTickets = $this->user->getBoughtLotteryTickets($lottery);

        return view('user.lottery.my_tickets', compact('lottery', 'myTickets'));
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

    public function cancelled() {
        $lotteries = Lottery::where('status', Lottery::STATUS_CANCELLED)->orderBy('updated_at', 'DESC')->paginate(50);

        return view('user.lottery.cancelled', compact('lotteries'));
    }
}
