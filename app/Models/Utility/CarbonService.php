<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 22/10/18
 * Time: 11:41 PM
 */

namespace Models\Utility;


use Carbon\Carbon;

class CarbonService
{
    public function timezone(Carbon $carbon, $timezone){
        return $carbon->copy()->setTimezone($timezone);
    }
}