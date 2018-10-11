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

    public function manageSession($slug) {
        $game = Game::whereSlug($slug)->firstOrFail();
        $user = $this->user;
        $gameSession = $user->getOpenSession($game);
        $hasOpenSession = $gameSession !== null;

        return view('user.game.manage_session', compact('game', 'user', 'hasOpenSession', 'gameSession'));
    }

    public function playLive(Request $request, Game $game) {
        $credits = (float)$request->get('credits');

        if ( ! $game->enabled) {
            $this->flashNotifier->error(trans('frontend/game.game_disabled'));

            return redirect()->back();
        }

        if ($credits > $this->user->credits || $credits < 1) {
            $this->flashNotifier->error(trans('frontend/game.invalid_credits'));

            return redirect()->back();
        }

        // TODO: Create the session, deduct credits from user balance, pass game settings, credits, etc.

        return view("user.live-games.{$game->slug}", compact('game'));
    }

    public function resumeSession(Game $game) {
        $gameSession = $this->user->getOpenSession($game);

        if ($gameSession === null) {
            $this->flashNotifier->error(trans('frontend/game.invalid_session'));

            return redirect()->back();
        }

        if ( ! $game->enabled) {
            $this->flashNotifier->error(trans('frontend/game.game_disabled'));

            return redirect()->back();
        }

        if ($gameSession->pivot->credits <= 0) {
            $this->user->closeGameSession($game);

            $this->flashNotifier->error(trans('frontend/game.session_no_credits'));

            return redirect()->back();
        }


    }
}
