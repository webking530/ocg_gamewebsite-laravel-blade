<?php

namespace App\Models\Gaming;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $guarded = ['id'];

    const TYPE_NORMAL = 0;
    const TYPE_INSTANT_WIN = 1;

    const GROUP_SLOT = 0;
    const GROUP_ROULETTE = 1;
    const GROUP_CARD = 2;
    const GROUP_BINGO = 3;
    const GROUP_OTHER = 4;

    public function getNameAttribute() {
        return trans('games.name.' . $this->id);
    }

    public function getFormattedTypeAttribute() {
        return trans('games.type.' . $this->type);
    }

    public function getFormattedGroupAttribute() {
        return trans('games.group.' . $this->group);
    }

    public function getSmallIconAttribute() {
        return "img/games/icons/{$this->id}.png";
    }

    public function scopeEnabled($query) {
        return $query->where('enabled', true);
    }

    public function isInstantWin() {
        return $this->type === self::TYPE_INSTANT_WIN;
    }
}
