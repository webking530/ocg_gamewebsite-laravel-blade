<?php

namespace Models\Gaming;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;
use Models\Auth\User;

class LotteryTicket extends Model
{
    use BelongsToAUser;

    protected $table = 'lottery_ticket';
    protected $guarded = ['id'];

    protected $casts = [
        'numbers' => 'array'
    ];

    protected $dates = [
        'reserved_at'
    ];

    const MAX_USER_RESERVATIONS = 10;
    const RESERVATION_TIME_MINUTES = 10;

    public function lottery() {
        return $this->belongsTo(Lottery::class, 'lottery_id');
    }

    public function reserver()
    {
        return $this->belongsTo(User::class, 'reserver_id');
    }

    public function getFormattedNumbersForGameAttribute() {
        $numbers = [];

        foreach ($this->numbers as $number) {
            $numbers[] = $number - 1; // For lottery game, the numbers are indexed from 0, but in our DB they are stored from 1
        }

        return $numbers;
    }

    public function isReservedBy(User $user) {
        return $this->reserver_id == $user->id;
    }

    public function isAvailable() {
        return $this->reserver_id == null && $this->user_id == null;
    }
}
