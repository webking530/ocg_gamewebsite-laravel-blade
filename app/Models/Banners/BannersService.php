<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 12/09/18
 * Time: 01:35 PM
 */

namespace Models\Banners;

use Illuminate\Support\Collection;
use Models\Bonuses\Bonus;
use Models\Gaming\GameUserWinningCache;
use Models\News\News;

class BannersService
{
    public function getRecentWinners() {
        return GameUserWinningCache::orderBy('net_win', 'DESC')->get();
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