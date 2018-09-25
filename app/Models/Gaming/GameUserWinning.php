<?php

namespace Models\Gaming;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;

class GameUserWinning extends Model
{
    use BelongsToAUser;

    protected $table = 'game_user_winnings';
    protected $guarded = ['id'];

    public function game() {
        return $this->belongsTo(Game::class, 'game_id');
    }
}
