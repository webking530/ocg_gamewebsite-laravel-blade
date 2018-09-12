<?php

namespace App\Http\Controllers;

use App\Models\Gaming\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function playDemo($slug) {
        $game = Game::whereSlug($slug)->firstOrFail();
        $route = url("/demo-games/$slug/index.html");

        return view('frontend.demo', compact('route', 'game'));
    }
}
