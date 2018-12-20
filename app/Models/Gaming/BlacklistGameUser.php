<?php

namespace Models\Gaming;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;

class BlacklistGameUser extends Model
{
    use BelongsToAUser;
    use BelongsToAGame;

    protected $table = 'blacklist_game_user';
    protected $guarded = ['id'];


}
