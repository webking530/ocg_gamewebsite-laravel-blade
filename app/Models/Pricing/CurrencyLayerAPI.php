<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 19/03/18
 * Time: 11:49 AM
 */

namespace Models\Pricing;


use Carbon\Carbon;
use DB;

class CurrencyLayerAPI
{
    const REQUEST_URL = "http://www.apilayer.net/api/live?access_key=ebcbd8084bd5f99f554c10f9ae04f612";

    public function updateAllRates()
    {
        $currencyPairs = $this->pairCurrencies();
        $rates = $this->getExchangeRates();

        DB::beginTransaction();
        foreach ($currencyPairs as $pair) {
            $from = $pair[0];
            $to = $pair[1];

            $this->persistRate($from, $from, 1.0);
            $this->persistRate($from, $to, $this->calculateRate($rates, $from, $to));
        }
        DB::commit();

        return true;
    }

    /**
     * @param $from <p>Currency in ISO format</p>
     * @param $to <p>Currency in ISO format</p>
     * @return float
     */
    public function getExchangeRates() {
        $response = json_decode(file_get_contents(self::REQUEST_URL));

        return $response->quotes;
    }

    private function calculateRate($rates, $from, $to) {
        return $rates->{"USD$to"} / $rates->{"USD$from"};
    }

    /**
     * @return array
     */
    private function pairCurrencies()
    {
        $currencies = Currency::all()->toArray();
        $currencyCount = count($currencies);
        $currencyPairs = [];
        for ($i = 0; $i < $currencyCount; $i++) {
            for ($j = $i + 1; $j < $currencyCount; $j++) {
                $currencyPairs[] = ["{$currencies[$i]['code']}", "{$currencies[$j]['code']}"];
                $currencyPairs[] = ["{$currencies[$j]['code']}", "{$currencies[$i]['code']}"];
            }
        }

        return $currencyPairs;
    }

    private function persistRate($from, $to, $rate)
    {
        echo "{$from} / {$to} = {$rate}\n";

        $record = Exchange::firstOrNew(compact('from', 'to'));
        $record->rate = $rate;
        $record->updated_at = Carbon::now();
        $record->save();
    }
}