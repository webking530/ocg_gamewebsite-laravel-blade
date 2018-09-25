<?php

use Illuminate\Database\Seeder;
use Models\Pricing\CurrencyLayerAPI;

class ExchangeRatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** @type CurrencyLayerAPI $api */
        $api = app(CurrencyLayerAPI::class);
        $api->updateAllRates();
    }
}
