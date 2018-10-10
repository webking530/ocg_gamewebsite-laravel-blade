<?php

namespace App\Models\Gaming;

use Illuminate\Database\Eloquent\Model;
use Models\Location\HasLanguage;

class CustomGameGroup extends Model
{
    use HasLanguage;

    protected $table = 'custom_game_groups';
    protected $guarded = ['id'];

    const CUSTOM_GROUP_START_ID = 100;

    public static function getTransName($group, $locale) {
        return self::where('group', $group)->where('locale', $locale)->first()->name;
    }
}
