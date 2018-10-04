<?php

namespace Models\Gaming;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Models\Location\HasCountry;

class Lottery extends Model
{
    use HasCountry;

    protected $guarded = ['id'];
    protected $dates = [
        'date_open',
        'date_close',
        'date_begin'
    ];

    const STATUS_ACTIVE = 0;
    const STATUS_CANCELLED = 1;
    const STATUS_PENDING = 2;
    const STATUS_FINALIZED = 3;

    const TYPE_LOW_STAKE = 0;
    const TYPE_MID_STAKE = 1;
    const TYPE_HIGH_STAKE = 2;

    public function tickets() {
        return $this->hasMany(LotteryTicket::class, 'lottery_id');
    }

    public function unsoldTickets() {
        return $this->hasMany(LotteryTicket::class, 'lottery_id')->whereNull('user_id')->orderByRaw('RAND()');
    }

    public function isActive() {
        return (int)$this->status === self::STATUS_ACTIVE;
    }

    public function isPending() {
        return (int)$this->status === self::STATUS_PENDING;
    }

    public function getWinningTicket() {
        return $this->tickets()->whereWinner(true)->first();
    }

    public function getWinnerUser() {
        return $this->getWinningTicket()->user;
    }

    public function getDateEndAttribute() {
        return $this->date_begin->addHours(24);
    }

    public function getDaysSinceAttribute() {
        $days = $this->date_begin->diffInDays(Carbon::now());
        $days = $days == 0 ? 1 : $days;

        return $days;
    }

    public function getStakeTextAttribute() {
        switch ($this->type) {
            default:
            case self::TYPE_LOW_STAKE:
                return 'low_stake';
            case self::TYPE_MID_STAKE:
                return 'mid_stake';
            case self::TYPE_HIGH_STAKE:
                return 'high_stake';
        }
    }

    public function isSoldOut() {
        return $this->tickets()->whereNull('user_id')->count() == 0;
    }

    public function getBeginCountdown() {
        $now = Carbon::now();

        if ($now->timestamp >= $this->date_begin->timestamp) {
            return [
                'started' => true,
                'text' =>trans ('frontend/lottery.lottery_starting')
            ];
        }

        $text = null;

        $minutes = $this->date_begin->diffInMinutes($now);
        $days = (int)($minutes / (24 * 60));
        $minutes -= $days * 24 * 60;
        $hours = (int)($minutes / 60);
        $minutes %= 60;

        if ($days) {
            $text = trans('frontend/lottery.start_days', ['days' => $days, 'hours' => $hours, 'minutes' => $minutes]);
        } elseif ($hours) {
            $text = trans('frontend/lottery.start_hours', ['hours' => $hours, 'minutes' => $minutes]);

        } elseif ($minutes) {
            if ($minutes == 1) {
                $text = trans('frontend/lottery.start_minute');
            } else {
                $text = trans('frontend/lottery.start_minutes', ['minutes' => $minutes]);
            }

        }

        return [
            'started' => false,
            'text' => $text
        ];
    }

    public function getBoughtTicketsTotal() {
        return $this->tickets()->whereNotNull('user_id')->count() * $this->ticket_price;
    }

    public function getPotSize() {
        return (int)($this->tickets()->whereNotNull('user_id')->count() * $this->ticket_price * 0.5);
    }

    public function canDisplayPrize() {
        return $this->getPotSize() >= $this->prize;
    }

    public static function getLatestWin($stake) {
        return self::where('type', $stake)->where('status', self::STATUS_FINALIZED)->latest()->first();
    }

    public static function getHighestWin($stake) {
        return  self::join('lottery_ticket', 'lotteries.id', '=', 'lottery_ticket.lottery_id')
                ->where('lotteries.type', $stake)
                ->where('lotteries.status', self::STATUS_FINALIZED)
                ->whereNotNull('lottery_ticket.user_id')
                ->groupBy('lotteries.id')
                ->orderByRaw('COUNT(lottery_ticket.id) DESC')
                ->selectRaw('lotteries.id, lotteries.date_begin, lotteries.type, lotteries.status, lotteries.ticket_price')
                ->first();
    }
}
