<?php

namespace Models\Gaming;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;

class GameUserWinning extends Model
{
    use BelongsToAUser;
    use BelongsToAGame;

    protected $table = 'game_user_winnings';
    protected $guarded = ['id'];

    public function getNetWinAttribute() {
        $net = $this->win_amount - $this->lose_amount;

        return $net < 0 ? 0 : $net;
    }
}
