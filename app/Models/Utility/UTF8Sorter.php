<?php
namespace Models\Utility;

class UTF8Sorter
{

    private static $collators;


    public static function sort(&$array, $locale)
    {
        $collator = static::getCollator($locale);

        return collator_asort($collator, $array);
    }


    /**
     * @param                 $array
     * @param                 $locale
     * @param string|callable $sortBy
     * @return mixed
     */
    public static function sortBy(&$array, $locale, $sortBy = 'name')
    {
        $collator = static::getCollator($locale);

        if (is_string($sortBy)) {
            $sortBy = function ($a) use ($sortBy) {
                return $a[$sortBy];
            };
        }

        return uasort($array, function ($a, $b) use ($collator, $sortBy) {
            return collator_compare($collator, $sortBy($a), $sortBy($b));
        });

    }

    private static function getCollator($locale)
    {
        if (isset(static::$collators[$locale])) {
            return static::$collators[$locale];
        }

        return collator_create($locale);
    }

}