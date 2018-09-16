<?php

namespace App\Http\Controllers;

use App\Models\Bonuses\Bonus;
use App\Models\Gaming\Game;
use App\Models\Gaming\Tournament;
use Illuminate\Http\Request;
use Models\Auth\User;

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

    public function userProfile($username) {
        $user = User::whereNickname($username)->firstOrFail();

        return view('frontend.public_profile', compact('user'));
    }

    public function terms() {
        return view('frontend.terms');
    }

    public function policy() {
        return view('frontend.policy');
    }
}
