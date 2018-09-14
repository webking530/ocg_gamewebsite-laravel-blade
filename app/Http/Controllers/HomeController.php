<?php

namespace App\Http\Controllers;

use App\Models\Bonuses\Bonus;
use App\Models\Gaming\Game;
use App\Models\Gaming\Tournament;
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

    public function tournaments() {
        $tournaments = Tournament::orderBy('group', 'ASC')->get();

        return view('frontend.tournaments', compact('tournaments'));
    }

    public function bonuses() {
        $bonuses = Bonus::orderBy('name')->get();

        return view('frontend.bonuses', compact('bonuses'));
    }
}
