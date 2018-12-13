<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 12/09/18
 * Time: 01:35 PM
 */

namespace Models\Banners;


use Carbon\Carbon;
use Illuminate\Support\Collection;
use Models\Bonuses\Bonus;
use Models\Gaming\GameUserWinning;
use Models\News\News;

class BannersService
{
    public function getRecentWinners() {
        return GameUserWinning::where('win_amount', '>', 0)->latest()->take(16)->get()->shuffle();
    }

    public function getBonusContent() {
        return Bonus::orderByRaw('RAND()')->get()->chunk(3);
    }

    /**
     * @param int $amount
     * @return Collection
     */
    public function getLatestHeaderNews($amount = 2) {
        return News::currentNews()->orderBy('order', 'ASC')->take($amount)->get();
    }

    public function getLatestNews($amount = 2) {
        return News::orderBy('date_from', 'DESC')->take($amount)->get();
    }
}