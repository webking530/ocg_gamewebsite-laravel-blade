<?php

namespace App\Http\Controllers;

use Models\Gaming\Game;
use Illuminate\Http\Request;
use Models\Gaming\GameService;
use Models\Gaming\GameUserSession;

class GameController extends Controller
{
    private $gameService;

    public function __construct(GameService $gameService) {
        parent::__construct();

        $this->gameService = $gameService;
    }

    public function playDemo($slug) {
        $game = Game::whereSlug($slug)->firstOrFail();

        if ( ! $game->enabled) {
            $this->flashNotifier->error(trans('frontend/game.game_disabled'));

            return redirect()->back();
        }

        $token = GameUserSession::generateDemoToken($game);

        $session = GameUserSession::create([
            'game_id' => $game->id,
            'credits' => GameUserSession::DEMO_CREDITS,
            'credits_bonus' => 0,
            'token' => $token
        ]);

        $sessionData = $this->gameService->generateJSONSessionData($session->token, $session->credits);
        $gameData = $this->gameService->generateJSONGameData($game);

        //return view("user.live-games.{$game->slug}", compact('game', 'sessionData', 'gameData'));
        return view("user.live-games.layout.layout-iframe", compact('game', 'sessionData', 'gameData'));
    }
}
