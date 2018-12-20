<?php

namespace Models\Gaming;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;
use Models\Auth\User;

class GameUserSession extends Model
{
    use BelongsToAUser;
    use BelongsToAGame;

    protected $table = 'game_user_session';
    protected $guarded = ['id'];

    protected $casts = [
        'extra' => 'array'
    ];

    const DEMO_CREDITS = 100;
    const DEMO_SESSION_EXPIRATION_MINUTES = 60;

    public static function generateLiveToken(Game $game, User $user) {
        $now = Carbon::now();
        return 'live_' . substr(hash('sha256', "{$now->timestamp}.{$game->id}.{$user->id}." . uniqid()), 0, 6);
    }

    public static function generateDemoToken(Game $game) {
        $now = Carbon::now();
        return 'demo_' . substr(hash('sha256', "{$now->timestamp}.{$game->id}" . uniqid()), 0, 6);
    }
}
