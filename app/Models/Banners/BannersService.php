<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 12/09/18
 * Time: 01:35 PM
 */

namespace App\Models\Banners;


use App\Models\Bonuses\Bonus;
use App\Models\Gaming\Game;
use App\Models\News\News;

class BannersService
{
    public function getRecentWinners() {
        // TODO: implement it based on real user stats, for now we'll take random games to show it visually

        return Game::enabled()->orderByRaw('RAND()')->take(8)->get();
    }

    public function getBonusContent() {
        // TODO: filter by date
        return Bonus::orderByRaw('RAND()')->get()->chunk(3);
    }

    public function getLatestNews() {
        // TODO: filter by date
        return News::orderBy('date_from', 'DESC')->take(2)->get();
    }
}