<?php

namespace Models\Gaming;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;

class GameUserSession extends Model
{
    use BelongsToAUser;

    protected $table = 'game_user_session';
    protected $guarded = ['id'];

    public function game() {
        return $this->belongsTo(Game::class, 'game_id');
    }
}
