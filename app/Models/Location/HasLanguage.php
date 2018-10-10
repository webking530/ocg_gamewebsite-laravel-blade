<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 09/10/18
 * Time: 06:57 PM
 */

namespace Models\Location;


trait HasLanguage
{
    public function language()
    {
        return $this->belongsTo(Language::class, 'locale', 'code');
    }
}