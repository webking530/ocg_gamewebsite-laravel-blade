<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\Gaming\Game;
use Models\Gaming\Jackpot;

class GameController extends Controller
{
    public function games() {
        $games = Game::enabled()->orderBy('slug')->get();

        $currentJackpot = Jackpot::getCurrentJackpot();
        $highestJackpot = Jackpot::getHighestJackpot();
        $latestJackpot = Jackpot::getLatestJackpot();

        return view('user.game.index', compact('games', 'currentJackpot', 'highestJackpot', 'latestJackpot'));
    }

    public function playLive($slug) {
        $game = Game::whereSlug($slug)->firstOrFail();

        return view('user.game.play_live', compact('game'));
    }
}
