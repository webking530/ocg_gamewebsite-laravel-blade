<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 30/09/18
 * Time: 01:20 PM
 */

namespace Models\Gaming;

use App\Models\Gaming\CustomGameGroup;
use Models\Auth\User;

class GameService
{
    const NODE_SERVER_URL = 'http://localhost:3000';

    const ERROR_CODE_CUSTOM = 'custom';
    const ERROR_CODE_INVALID_BET = 'invalid_bet';
    const ERROR_CODE_INVALID_LINES = 'invalid_lines';
    const ERROR_CODE_INVALID_TOKEN = 'invalid_token';
    const ERROR_CODE_USER_NO_CREDITS = 'user_no_credits';
    const ERROR_CODE_GAME_NO_CREDITS = 'game_no_credits';


    public function getGroupsList() {
        $groups = [];

        foreach (Game::GROUP_LIST as $group) {
            $groups[$group] =  trans("games.group.$group");
        }

        return $groups;
    }

    public function getExtendedGroupsList() {
        $baseGroups = $this->getGroupsList();
        $language = \App::getLocale();

        $customGroups = CustomGameGroup::where('locale', $language)->orderBy('group', 'DESC')->pluck('name', 'group')->all();

        return $customGroups + $baseGroups;
    }

    public function validSessionToken(Game $game, $token) {
        //$session = $user->getOpenSession($game);
        $session = GameUserSession::where('game_id', $game->id)->where('token', $token)->first();

        if ($session === null) {
            return false;
        }

        return true;
    }

    public function validateClientGameSettings(Game $game, $clientSettings) {
        foreach ($clientSettings as $key => $value) {
            $currentServerSetting = $game->settings_decoded->{$key};

            // Check for paytable_symbol_1 and compare all but the last one, since it's dynamically generated based on Jackpot
            if ($game->has_jackpot && Jackpot::isRealJackpotEnabled() && $key === 'paytable_symbol_1') {
                array_pop($value);
                array_pop($currentServerSetting);
            }

            $clientSetting = json_encode($value, JSON_NUMERIC_CHECK);
            $serverSetting = json_encode($currentServerSetting, JSON_NUMERIC_CHECK);

            if ($clientSetting !== $serverSetting) {
                return false;
            }
        }

        return true;
    }

    public function generateMathFiles() {
        exec('cd /web/ocgcasino.com/ocg_math/public && sh math.sh > /dev/null &');

        $this->restartMathServer();
    }

    public function restartMathServer() {
        exec('kill -9 $(lsof -ti :3000)');
        exec('cd /web/ocgcasino.com/ocg_math/public && nodejs server.js > /dev/null &');
    }
}