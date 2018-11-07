<?php

namespace Models\Bonuses;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model {

    protected $table = 'bonuses';
    protected $guarded = ['id'];

    const TYPE_CREDITS = 0;
    const TYPE_MULTIPLIER = 1;
    const TYPE_PERCENT = 2;
    const SLUG_WELCOME = 'welcome';

    public function getIconAttribute() {
        switch ($this->type) {
            default:
            case self::TYPE_CREDITS:
                return 'fas fa-coins';
            case self::TYPE_MULTIPLIER:
                return 'fas fa-dice';
            case self::TYPE_PERCENT:
                return 'fas fa-percent';
        }
    }

    public function getFormattedPrizeAttribute() {
        $prize = number_format($this->prize);

        switch ($this->type) {
            default:
            case self::TYPE_CREDITS:
                return $prize . ' <i class="fas fa-coins"></i>';
            case self::TYPE_MULTIPLIER:
                return $prize . ' <i class="fas fa-times"></i> ';
            case self::TYPE_PERCENT:
                return $prize . ' <i class="fas fa-percent"></i> ';
        }
    }

    public function getFormattedTypeAttribute() {
        return trans("frontend/bonuses.type.{$this->type}");
    }

}
