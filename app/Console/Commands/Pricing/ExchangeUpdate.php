<?php namespace App\Console\Commands\Pricing;

use Illuminate\Console\Command;
use Models\Pricing\CurrencyLayerAPI;

class ExchangeUpdate extends Command
{

    protected $signature = 'pricing:update-exchange-rates';
    protected $description = 'Update the exchange rate for the supported currencies.';

    public function handle()
    {
        /** @type CurrencyLayerAPI $api */
        $api = app(CurrencyLayerAPI::class);
        $api->updateAllRates();
    }
}
