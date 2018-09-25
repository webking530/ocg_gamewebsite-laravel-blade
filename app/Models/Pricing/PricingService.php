<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 15/09/18
 * Time: 12:06 PM
 */

namespace Models\Pricing;


use Illuminate\Database\Eloquent\ModelNotFoundException;

class PricingService
{
    public function getCurrenciesList() {
        return Currency::orderBy('code')->get()->pluck('formatted_code', 'code')->all();
    }

    public function exchange($amount, $from, $to, $inverted = false)
    {
        $rate = $inverted ? 1.0 / $this->rate($to, $from) : $this->rate($from, $to);

        return $amount * $rate;
    }

    public function exchangeCredits($amount, $to, $inverted = false)
    {
        $from = 'USD'; // 1 Credit is equal to 1 USD

        $rate = $inverted ? 1.0 / $this->rate($to, $from) : $this->rate($from, $to);

        return $amount * $rate;
    }

    public function countryCurrency($countryCode, $enabledOnly = true)
    {
        $country = Country::findOrFail($countryCode);

        if ($enabledOnly && ! $country->enabled) {
            throw new ModelNotFoundException;
        }

        return $country->currency()->select('code', 'symbol')->firstOrFail();
    }

    public function rate($from, $to)
    {
        return Exchange::whereFrom($from)->whereTo($to)->firstOrFail()->rate;
    }

    public function currency($user, $countryCode, $enabledOnly = true)
    {
        if ($user && $currency = $user->currency()->select('symbol', 'code')->first()) {
            return $currency;
        }

        return $this->countryCurrency($countryCode, $enabledOnly);
    }

    public function currencyCode($user, $countryCode)
    {
        return $this->currency($user, $countryCode)->code;
    }
}