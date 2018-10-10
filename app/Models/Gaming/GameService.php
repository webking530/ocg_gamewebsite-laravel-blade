<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 30/09/18
 * Time: 01:20 PM
 */

namespace Models\Gaming;

use App\Models\Gaming\CustomGameGroup;

class GameService
{
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
}