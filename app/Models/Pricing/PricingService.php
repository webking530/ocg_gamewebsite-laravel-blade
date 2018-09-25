<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 15/09/18
 * Time: 12:06 PM
 */

namespace Models\Pricing;


class PricingService
{
    public function getCurrenciesList() {
        return Currency::orderBy('code')->get()->pluck('formatted_code', 'code')->all();
    }
}