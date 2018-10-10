<?php

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Models\Pricing\Currency::create([
            'code' => 'EUR',
            'symbol' => '€'
        ]);

        \Models\Pricing\Currency::create([
            'code' => 'GBP',
            'symbol' => '£'
        ]);

        \Models\Pricing\Currency::create([
            'code' => 'TRY',
            'symbol' => '₺'
        ]);

        \Models\Pricing\Currency::create([
            'code' => 'USD',
            'symbol' => '$'
        ]);

        DB::table('languages')->insert([
            'code' => 'en'
        ]);

        DB::table('languages')->insert([
            'code' => 'es'
        ]);

        DB::table('languages')->insert([
            'code' => 'tr'
        ]);

        \Models\Location\Country::create([
            'code' => 'DE',
            'currency_code' => 'EUR',
            'pricing_currency' => 'EUR',
            'locale' => 'en',
            'capital_timezone' => 'Europe/Berlin',
            'enabled' => true
        ]);
    }
}
