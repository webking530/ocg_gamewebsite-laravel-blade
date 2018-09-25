<?php

namespace Models\Gaming;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;

class LotteryTicket extends Model
{
    use BelongsToAUser;

    protected $table = 'lottery_ticket';
    protected $guarded = ['id'];

    protected $casts = [
        'numbers' => 'array'
    ];

    public function lottery() {
        return $this->belongsTo(Lottery::class, 'lottery_id');
    }

    public function getFormattedNumbersForGameAttribute() {
        $numbers = [];

        foreach ($this->numbers as $number) {
            $numbers[] = $number - 1; // For lottery game, the numbers are indexed from 0, but in our DB they are stored from 1
        }

        return $numbers;
    }
}
