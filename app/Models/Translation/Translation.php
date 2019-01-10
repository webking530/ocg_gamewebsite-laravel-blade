<?php

namespace Models\Translation;

use Illuminate\Database\Eloquent\Model;
use Models\Auth\BelongsToAUser;

class Translation extends Model
{
    use BelongsToAUser;

    protected $guarded = ['id'];

    public function scopeEntries($query)
    {
        return $query->groupBy('group', 'key');
    }

    public static function getGlobalProgress($sourceLocale, $targetLocale) {
        $sourceCount = self::where('locale', $sourceLocale)->count();
        $targetCount = self::where('locale', $targetLocale)->count();

        $sourceWordCount = self::where('locale', $sourceLocale)->selectRaw('SUM(LENGTH(value) - LENGTH(REPLACE(value, \' \', \'\')) + 1) AS words')->first()->words;

        return [
            'sourceCount' => $sourceCount,
            'targetCount' => $targetCount,
            'percent' => 100 * $targetCount / $sourceCount,
            'words' => $sourceWordCount
        ];
    }
}
