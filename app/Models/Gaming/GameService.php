<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 30/09/18
 * Time: 01:20 PM
 */

namespace Models\Gaming;

class GameService
{
    public function getGroupsList() {
        $groups = [];

        foreach (Game::GROUP_LIST as $group) {
            $groups[$group] =  trans("games.group.$group");
        }

        return $groups;
    }
}