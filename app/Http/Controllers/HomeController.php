<?php

namespace App\Http\Controllers;

use App\Models\Gaming\Game;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $games = Game::enabled()->orderByRaw('RAND()')->get();

        return view('frontend.home', compact('games'));
    }

    public function game($slug) {
        $game = Game::whereSlug($slug)->firstOrFail();

        return view('frontend.game', compact('game'));
    }
}
