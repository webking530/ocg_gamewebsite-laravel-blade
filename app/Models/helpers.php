<?php

use Carbon\Carbon;
use Illuminate\Support\Debug\Dumper;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberFormat;
use Models\Pricing\Currency;
use Models\Setting\SettingsManager;

if (!function_exists('set_active')) {

    /**
     * Returns the active state if the current url is the same as the passed route name.
     * @param string $routePattern
     * @param string $active
     * @return string
     */
    function set_active($routePattern, $active = 'active') {
        return is_route($routePattern) ? $active : '';
    }

    function set_active_href($routePattern, $active = '#', $route = null) {
        $route = $route ?: $routePattern;

        return is_route($routePattern) ? $active : route($route);
    }

    /**
     * @param $routePattern
     * @return bool
     */
    function is_route($routePattern) {
        return str_is($routePattern, Route::currentRouteName());
    }

}

if (!function_exists('settings')) {


    /**
     * Get/Set the specified settings value.
     * @param array|string $key
     * @param null         $value
     * @return SettingsManager|mixed
     */
    function settings($key = null, $value = null) {
        $settings = new SettingsManager();

        if (is_null($key)) {
            return $settings;
        }

        if (is_array($key)) {
            return $settings->setArray($key);
        }

        if (func_num_args() == 1) {
            return $settings->get($key);
        }

        return $settings->set($key, $value);
    }

}

if (!function_exists('enabled')) {

    /**
     * Checks if a certain SMSwords feature is enabled.
     * @param        $feature
     * @return boolean
     */
    function enabled($feature) {
        return (bool) settings($feature . '_enabled');
    }

}

if (!function_exists('disabled')) {

    /**
     * Checks if a certain SMSwords feature is disabled.
     * @param        $feature
     * @return boolean
     */
    function disabled($feature) {
        return !enabled($feature);
    }

}

if (!function_exists('set_enabled')) {

    /**
     * Sets disabled state if the feature is inactive.
     * @param        $feature
     * @param string $disabled
     * @return string
     */
    function set_enabled($feature, $disabled = 'disabled') {
        return enabled($feature) ? '' : $disabled;
    }

}

if (!function_exists('set_enabled_href')) {

    /**
     * Sets the href of a link if the corresponding feature is enabled
     * @param $feature
     * @param $routeName
     * @return string
     */
    function set_enabled_href($feature, $routeName) {
        return enabled($feature) ? route($routeName) : '#';
    }

}

if (!function_exists('localized_url')) {

    /**
     * Get the localized URL of a the current page. It is a wrapper around LaravelLocalization::getLocalizedURL.
     * @param $locale
     * @return string
     */
    function localized_url($locale) {
        /**
         * Remove PJAX parameter.
         */
        $query = Request::query();
        unset($query['_pjax']);
        $url = $query ? Request::url() . '?' . http_build_query($query) : Request::url();

        return LaravelLocalization::getLocalizedURL($locale, $url, $query);
    }

}

if (!function_exists('_e')) {

    /**
     * Escapes text for printing, but allowing new lines.
     *
     * @param string $text
     * @return string
     */
    function _e($text) {
        return nl2br(e(preg_replace('/<br\s?\/?>/', "\n", $text)));
    }

}

if (!function_exists('s')) {

    /**
     *  isset wrapper
     * @param            $var
     * @param null|mixed $default
     * @return mixed
     */
    function s(&$var, $default = null) {
        return isset($var) ? $var : $default;
    }

}

function formatted_price($price, $currency, $decimals = 2) {
    if (is_string($currency)) {
        $currency = Currency::findOrFail($currency);
    }

    return $currency->symbol . number_format($price, $decimals) . ' ' . $currency->code;
}

function country_name($code) {
    return Countries::getOne($code, LaravelLocalization::getCurrentLocale());
}

function xml_to_array($xml) {
    return json_decode(json_encode($xml), true);
}

function text_excerpt($text, $len = 100) {
    if ($len >= mb_strlen($text)) {
        return $text;
    }

    //return mb_strimwidth($text, 0, mb_strpos($text, ' ', $len));
    return mb_strimwidth($text, 0, $len);
}

function random_number_array($ticketAmount) {
    $finalArray = [];
    for ($len = 0; $len < $ticketAmount; $len++) {
        $arr = array();
        $i = 0;
        while ($i < 6) {
            $num = rand(1, 36);
            $c = 0;
            for ($j = 0; $j < 4; $j++) {
                if (isset($arr[$j]) && $arr[$j] == $num) {
                    $c++;
                    break;
                }
            }
            if ($c == 0) {
                if (!in_array($num, $arr)) {
                    $arr[$i] = $num;
                    $i++;
                }
            }
        }
        $finalArray[] = $arr;
    }
    return $finalArray;
}

function is_production() {
    return env('APP_ENV') == 'production';
}
