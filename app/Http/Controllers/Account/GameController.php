<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\Gaming\Game;

class GameController extends Controller
{
    public function playLive($slug) {
        $game = Game::whereSlug($slug)->firstOrFail();

        return view('user.game.play_live', compact('game'));
    }
}
