<?php

namespace Models\Gaming;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;

class GameUserWinningCache extends Model
{
    use BelongsToAUser;
    use BelongsToAGame;

    protected $table = 'game_user_winnings_cache';
    protected $guarded = ['id'];
}
