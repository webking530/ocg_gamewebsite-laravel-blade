<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 15/09/18
 * Time: 12:02 PM
 */

namespace Models\Location;

use Request;

class LocationService
{
    public function getEnabledCountriesList() {
        return Country::enabled()->get()->sortBy('name')->pluck('name', 'code')->all();
    }

    public function countryCodeByIP() {
        $code = geoip_country_code_by_name(Request::ip());
        $supportedCountries = Country::all()->pluck('code')->all();

        return $code === false || ! in_array($code, $supportedCountries) ? 'GB' : $code;
    }
}