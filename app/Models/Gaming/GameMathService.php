<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 16/12/18
 * Time: 03:18 PM
 */

namespace Models\Gaming;


class GameMathService
{
    const NODE_SERVER_URL = 'http://localhost:3000';

    const ERROR_CODE_CUSTOM = 'custom';
    const ERROR_CODE_INVALID_BET = 'invalid_bet';
    const ERROR_CODE_INVALID_LINES = 'invalid_lines';
    const ERROR_CODE_INVALID_TOKEN = 'invalid_token';
    const ERROR_CODE_USER_NO_CREDITS = 'user_no_credits';
    const ERROR_CODE_GAME_NO_CREDITS = 'game_no_credits';

    /**
     * @var GameService
     */
    private $gameService;
    private $game;
    private $token;
    private $bet;
    private $lines;

    public function __construct(Game $game, $token, $bet, $lines) {
        $this->gameService = new GameService();
        $this->game = $game;
        $this->token = $token;
        $this->bet = $bet;
        $this->lines = $lines;
    }

    public function getPlayResponse() {

    }

    public function getTotalBet() {
        return $this->bet * $this->lines;
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