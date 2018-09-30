<?php

namespace App\Http\Controllers;

use Models\Bonuses\Bonus;
use Models\Gaming\Game;
use Models\Gaming\Jackpot;
use Illuminate\Http\Request;
use Models\Auth\User;

class HomeController extends Controller
{
    public function index() {
        $games = Game::enabled()->orderByRaw('RAND()')->get();

        $currentJackpot = Jackpot::getCurrentJackpot();
        $highestJackpot = Jackpot::getHighestJackpot();
        $latestJackpot = Jackpot::getLatestJackpot();

        return view('frontend.home', compact('games', 'currentJackpot', 'highestJackpot', 'latestJackpot'));
    }

    public function game($slug) {
        $game = Game::whereSlug($slug)->firstOrFail();

        return view('frontend.game', compact('game'));
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
