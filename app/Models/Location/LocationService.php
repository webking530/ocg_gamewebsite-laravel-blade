<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 15/09/18
 * Time: 12:02 PM
 */

namespace App\Models\Location;


use Models\Location\Country;

class LocationService
{
    public function getEnabledCountriesList() {
        return Country::enabled()->get()->sortBy('name')->pluck('name', 'code')->all();
    }
}