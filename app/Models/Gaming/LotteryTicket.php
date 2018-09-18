<?php

namespace App\Models\Gaming;

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
}
