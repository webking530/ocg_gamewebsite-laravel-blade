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
            if ($this->bet != $this->session->extra['bet'] || $this->lines != $this->session->extra['lines']) {
                $this->bet = $this->session->extra['bet'];
                $this->lines = $this->session->extra['lines'];

                BlacklistGameUser::create([
                    'game_id' => $this->game->id,
                    'user_id' => $this->session->user->id
                ]);
            }
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

        if ( ! $this->hasPendingFreeSpins()) {
            if ($this->getTotalCredits() <= 0 || $this->getTotalBet() > $this->getTotalCredits()) {
                return $this->generatePlayErrorResponse(GameMathService::ERROR_CODE_USER_NO_CREDITS);
            }
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

        if ($this->hasPendingFreeSpins()) {
            $loseAmount = 0;
        } else {
            $loseAmount = $this->getTotalBet();
        }

        DB::beginTransaction();

        $this->distributeCreditsToSession($winAmount, $loseAmount);

        $sessionExtra = $this->session->extra;

        if ($sessionExtra == null) {
            $sessionExtra = [
                'free_spins' => 0,
                'bet' => 0,
                'lines' => 0
            ];
        }

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

        if ($this->isLiveToken) {
            if ($winAmount > 0) {
                $this->session->user->addWinMoneyToRunningTournaments($this->game, $winAmount);
            }

            if ($loseAmount > 0) {
                $this->session->user->addLoseMoneyToRunningTournaments($this->game, $loseAmount);
            }

            GameUserWinning::create([
                'game_id' => $this->game->id,
                'user_id' => $this->session->user->id,
                'win_amount' => $winAmount,
                'lose_amount' => $loseAmount,
                'token' => $this->token
            ]);
        }

        DB::commit();

        $result->credits = $this->getTotalCredits() * 100; // Game works in cents
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
        if ($this->session == null || $this->session->extra == null) {
            return 0;
        }

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
                'credits' => $this->session == null ? 0 : $this->getTotalCredits() * 100,
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

    // Loses must be deducted from bonus credits first, then from regular credits
    // Earnings must always be summed to regular credits
    private function distributeCreditsToSession($winAmount, $loseAmount) {
        if ($loseAmount > 0) {
            $creditsBonus = $this->session->credits_bonus;
            $creditsBonus -= $loseAmount;

            if ($creditsBonus < 0) {
                $remainder = abs($creditsBonus);
                $creditsBonus = 0;

                $this->session->credits -= $remainder;
            }

            $this->session->credits_bonus = $creditsBonus;
        }

        $this->session->credits += $winAmount;
    }

    private function getTotalCredits() {
        return $this->session->credits + $this->session->credits_bonus;
    }

    private function getTotalBet() {
        return $this->bet * $this->lines;
    }

    private function isValidSession() {
        return $this->gameService->validSessionToken($this->game, $this->token);
    }

    public static function generateMathFiles() {
        exec('cd /web/ocg_math/public && sh math.sh > /tmp/ocg_math_generate.txt &');

        $output = file_get_contents('/tmp/ocg_math_generate.txt');

        $output .= self::restartMathServer();

        return $output;
    }

    public static function restartMathServer() {
        exec('kill -9 $(lsof -ti :3000)');
        exec('cd /web/ocg_math/public && nodejs server.js > /tmp/ocg_math_server &');

        return file_get_contents('/tmp/ocg_math_server.txt');
    }
}