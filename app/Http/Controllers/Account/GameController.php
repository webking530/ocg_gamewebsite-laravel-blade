<?php

namespace App\Http\Controllers\Account;

use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Models\Gaming\Game;
use Models\Gaming\GameService;
use Models\Gaming\GameUserSession;
use Models\Gaming\GameUserWinning;
use Models\Gaming\Jackpot;

class GameController extends Controller
{
    private $gameService;

    public function __construct(GameService $gameService) {
        parent::__construct();

        $this->gameService = $gameService;
    }

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

    public function depositToGame(Request $request, Game $game) {
        $credits = (float)$request->get('credits');
        $creditsBonus = (float)$request->get('credits_bonus');

        if ( ! $game->enabled) {
            $this->flashNotifier->error(trans('frontend/game.game_disabled'));

            return redirect()->back();
        }

        if ($credits > $this->user->credits || $credits < 1 || $creditsBonus > $this->user->credits_bonus) {
            $this->flashNotifier->error(trans('frontend/game.invalid_credits'));

            return redirect()->back();
        }

        $gameSession = $this->user->getOpenSession($game);

        if ($gameSession !== null) {
            $this->flashNotifier->error(trans('frontend/game.session_already_open'));

            return redirect()->back();
        }

        $now = Carbon::now();

        DB::beginTransaction();

        $this->user->gameSessions()->attach($game->id, [
            'credits' => $credits,
            'credits_bonus' => $creditsBonus,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $this->user->credits -= $credits;
        $this->user->credits_bonus -= $creditsBonus;
        $this->user->save();

        DB::commit();

        return redirect()->route('user.games.play_live', ['game' => $game]);
    }

    public function playLive(Game $game) {
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

        // Create a new token every time the user decides to play. This will later be checked in-game
        // to prevent having multiple tabs with the same game open
        $now = Carbon::now();
        $token = substr(hash('sha256', "{$now->timestamp}.{$game->id}.{$this->user->id}." . uniqid()), 0, 6);

        $this->user->gameSessions()->updateExistingPivot($game->id, [
            'token' => $token,
            'updated_at' => $now
        ]);

        return view("user.live-games.{$game->slug}", compact('game', 'token'));
    }

    public function playRequest(Request $request, Game $game) {
        $bet = (int)$request->get('bet') / 100;
        $lines = (int)$request->get('lines');
        $token = $request->get('token');

        if ($bet < 0.01) {
            return 'invalid bet';
        }

        if ($lines < 1) {
            return 'invalid lines';
        }

        if ( ! $this->gameService->validSessionToken($game, $token)) {
            return 'invalid token';
        }

        $session = GameUserSession::where('token', $token)->first();

        $totBet = $bet * $lines;

        if ($session->credits < 0 || $totBet > $session->credits) {
            return 'out of credits';
        }

        $query = http_build_query([
            'game' => $game->slug,
            'lines' => $lines
        ]);
        $result = json_decode(file_get_contents(GameService::NODE_SERVER_URL . "?" . $query));

        if ($result->ErrorOccured) {
            return $result->ExceptionMessage;
        }

        $result = $result->Result;

        if (count($result->wins)) {
            $winAmount = $bet * $result->win;
        } else {
            $winAmount = - $totBet;
        }

        $session->credits += $winAmount;
        $session->save();

        $result->credits = $session->credits * 100;

        return json_encode($result);
    }

    public function checkToken(Request $request, Game $game) {
        $token = $request->get('token');

        if ( ! $this->gameService->validSessionToken($game, $token)) {
            return 'invalid';
        }

        return 'ok';
    }

    public function checkSettings(Request $request, Game $game) {
        $token = $request->get('token');
        $settings = $request->get('settings');

        if ( ! $this->gameService->validSessionToken($game, $token)) {
            return 'invalid';
        }

        if ( ! $this->gameService->validateClientGameSettings($game, $settings)) {
            return 'invalid';
        }

        return 'ok';
    }

    public function closeSession(Game $game) {
        try {
            $this->user->closeGameSession($game);
            return 'ok';
        } catch (\Exception $ex) {
            return 'error';
        }
    }

    public function saveCreditsToSession(Request $request, Game $game) {
        $token = $request->get('token');
        $settings = $request->get('settings');

        if ( ! $this->gameService->validSessionToken($game, $token)) {
            return 'invalid';
        }

        if ( ! $this->gameService->validateClientGameSettings($game, $settings)) {
            return 'invalid';
        }

        $session = $this->user->getOpenSession($game);
        $credits = (float)$request->get('credits');

        $earning = $credits - $session->pivot->credits;

        DB::beginTransaction();

        $this->user->gameSessions()->updateExistingPivot($game->id, [
            'credits' => $credits,
            'updated_at' => Carbon::now()
        ]);

        if ($earning > 0) {
            $game->subCredits($earning);

            GameUserWinning::create([
                'game_id' => $game->id,
                'user_id' => $this->user->id,
                'win_amount' => $earning
            ]);

            // We will not add Jackpot won amount to the tournament, since it will throw out of balance the TPA
            if (Jackpot::isRealJackpotEnabled() && Jackpot::amountIsCloseToJackpot($earning)) {
                Jackpot::create([
                    'user_id' => $this->user->id,
                    'prize' => $earning
                ]);
            } else {
                $this->user->addWinMoneyToRunningTournaments($game, $earning);
            }
        } else {
            $game->addCredits(abs($earning));

            $this->user->addLoseMoneyToRunningTournaments($game, abs($earning));
        }

        DB::commit();

        return 'ok';
    }
}
