<?php

namespace App\Http\Controllers;

use Models\Gaming\Game;
use Illuminate\Http\Request;
use Models\Gaming\GameUserSession;

class GameController extends Controller
{
    public function playDemo($slug) {
        $game = Game::whereSlug($slug)->firstOrFail();
        $route = url("/demo-games/$slug/index.html");

        $token = GameUserSession::generateDemoToken($game);

        GameUserSession::create([
            'game_id' => $game->id,
            'credits' => GameUserSession::DEMO_CREDITS,
            'credits_bonus' => 0,
            'token' => $token
        ]);

        return view('frontend.demo', compact('route', 'game', 'token'));
    }
}
