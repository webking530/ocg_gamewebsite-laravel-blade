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
use App\Models\Gaming\GameUserWinning;
use App\Models\News\News;

class BannersService
{
    public function getRecentWinners() {
        return GameUserWinning::latest()->take(16)->get()->shuffle();
    }

    public function getBonusContent() {
        return Bonus::orderByRaw('RAND()')->get()->chunk(3);
    }

    public function getLatestNews() {
        return News::orderBy('date_from', 'DESC')->take(2)->get();
    }
}