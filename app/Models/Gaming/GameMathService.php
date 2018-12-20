<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 16/12/18
 * Time: 03:18 PM
 */

namespace Models\Gaming;


use DB;

class GameMathService
{
    const NODE_SERVER_URL = 'http://localhost:3000';

    const ERROR_CODE_CUSTOM = 'custom';
    const ERROR_CODE_CONNECTION_FAILED = 'connection_failed';
    const ERROR_CODE_INVALID_BET = 'invalid_bet';
    const ERROR_CODE_INVALID_LINES = 'invalid_lines';
    const ERROR_CODE_INVALID_TOKEN = 'invalid_token';
    const ERROR_CODE_USER_NO_CREDITS = 'user_no_credits';
    const ERROR_CODE_GAME_NO_CREDITS = 'game_no_credits';

    /**
     * @var GameService
     */
    private $gameService;

    /**
     * @var GameUserSession $session
     */
    private $session;

    private $game;
    private $token;
    private $bet;
    private $lines;

    private $isLiveToken;

    private $serverResponse;

    public function __construct(Game $game, $token, $bet, $lines) {
        $this->gameService = new GameService();
        $this->game = $game;
        $this->token = $token;
        $this->bet = $bet;
        $this->lines = $lines;

        $this->isLiveToken = strpos($this->token, 'demo_') === false;
        $this->session = GameUserSession::where('token', $this->token)->first();

        // For free spins, bet and lines should be unchanged, just like they were when the player won the free spin
        // this is just a check to avoid cheating
        if ($this->session != null && $this->hasPendingFreeSpins()) {
            $this->bet = $this->session->extra['bet'];
            $this->lines = $this->session->extra['lines'];

            BlacklistGameUser::create([
                'game_id' => $this->game->id,
                'user_id' => $this->session->user->id
            ]);
        }
    }

    public function getPlayResponse() {
        if ( ! $this->isValidSession()) {
            return $this->generatePlayErrorResponse(GameMathService::ERROR_CODE_INVALID_TOKEN);
        }

        if ($this->bet < 0.01) {
            return $this->generatePlayErrorResponse(GameMathService::ERROR_CODE_INVALID_BET);
        }

        if ($this->lines < 1) {
            return $this->generatePlayErrorResponse(GameMathService::ERROR_CODE_INVALID_LINES);
        }

        if ($this->session->credits <= 0 || $this->getTotalBet() > $this->session->credits) {
            return $this->generatePlayErrorResponse(GameMathService::ERROR_CODE_USER_NO_CREDITS);
        }

        $this->serverResponse = $this->getMathServerResponse();

        if ($this->serverResponse == null) {
            return $this->generatePlayErrorResponse(GameMathService::ERROR_CODE_CONNECTION_FAILED);
        }

        if ($this->serverResponse->ErrorOccured) {
            return $this->generatePlayErrorResponse(GameMathService::ERROR_CODE_CUSTOM);
        }

        $result = $this->serverResponse->Result;

        if (count($result->wins)) {
            $winAmount = $this->bet * $result->win;

            if ($result->bonus && $result->bonusData->amount > 0) {
                $winAmount += $this->getTotalBet() * $result->bonusData->amount;
            }
        } else {
            $winAmount = 0;
        }

        if ( ! $this->hasPendingFreeSpins()) {
            $winAmount -= $this->getTotalBet();
        }

        DB::beginTransaction();

        $this->session->credits += $winAmount;

        $sessionExtra = $this->session->extra;

        if ($this->hasPendingFreeSpins()) {
            $sessionExtra['free_spins']--;
        }

        if ($result->freeSpins && $result->freeSpinsData > 0) {
            $sessionExtra['free_spins'] += $result->freeSpinsData;
            $sessionExtra['bet'] = $this->bet;
            $sessionExtra['lines'] = $this->lines;
        }

        $this->session->extra = $sessionExtra;
        $this->session->save();

        DB::commit();

        $result->credits = $this->session->credits * 100; // Game works in cents
        $result->freeSpinsData = $this->getPendingFreeSpins();

        return json_encode([
            'data' => $result,
            'error' => [
                'code' => 'success',
                'message' => ''
            ]
        ]);
    }

    private function getMathServerResponse() {
        $query = http_build_query([
            'game' => $this->getConfigName(),
            'lines' => $this->lines
        ]);

        $response = file_get_contents(GameMathService::NODE_SERVER_URL . "?" . $query);

        if (empty($response)) {
            return null;
        }

        return json_decode($response);
    }

    private function getConfigName() {
        $name = $this->game->settings['config_name'];

        if ($this->hasPendingFreeSpins()) {
            $name .= 'FreeSpins';
        }

        if ( ! $this->isLiveToken) {
            $name .= 'Demo';
        }

        return $name;
    }

    private function getPendingFreeSpins() {
        return $this->session->extra['free_spins'];
    }

    private function hasPendingFreeSpins() {
        return $this->getPendingFreeSpins() > 0;
    }

    private function generatePlayErrorResponse($errorCode) {
        return json_encode([
            'data' => [
                'combination' => [
                    [1,2,3,4,5],
                    [1,2,3,4,5],
                    [1,2,3,4,5]
                ],
                'win' => 0,
                'wins' => [],
                'credits' => $this->session->credits * 100,
                'bonus' => false,
                'numItemInBonus' => 0,
                'bonusData' => [
                    'id' => -1,
                    'amount' => -1
                ],
                'freeSpins' => false,
                'freeSpinsData' => $this->getPendingFreeSpins()
            ],
            'error' => [
                'code' => $errorCode,
                'message' => $this->getErrorMessage($errorCode)
            ]
        ]);
    }

    private function getErrorMessage($errorCode) {
        if ($errorCode == self::ERROR_CODE_CUSTOM) {
            return $this->serverResponse->ExceptionMessage;
        }

        return trans("games.errors.$errorCode");
    }

    private function getTotalBet() {
        return $this->bet * $this->lines;
    }

    private function isValidSession() {
        return $this->gameService->validSessionToken($this->game, $this->token);
    }

    public static function generateMathFiles() {
        exec('cd /web/ocg_math/public && sh math.sh > /dev/null &');

        self::restartMathServer();
    }

    public static function restartMathServer() {
        exec('kill -9 $(lsof -ti :3000)');
        exec('cd /web/ocg_math/public && nodejs server.js > /dev/null &');
    }
}