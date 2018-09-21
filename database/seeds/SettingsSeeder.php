<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Models\Setting\Setting::create([
            'key' => 'enable_fake_statistics',
            'value' => 'true',
        ]);

        Models\Setting\Setting::create([
            'key' => 'fake_users_amount',
            'value' => '25000',
        ]);

        Models\Setting\Setting::create([
            'key' => 'fake_money_paid',
            'value' => '250000',
        ]);

        Models\Setting\Setting::create([
            'key' => 'fake_highest_lottery_pot',
            'value' => '75000',
        ]);

        Models\Setting\Setting::create([
            'key' => 'fake_highest_lottery_pot',
            'value' => '75000',
        ]);

        Models\Setting\Setting::create([
            'key' => 'enable_fake_jackpot',
            'value' => 'true',
        ]);

        Models\Setting\Setting::create([
            'key' => 'fake_jackpot_current',
            'value' => '10000',
        ]);

        Models\Setting\Setting::create([
            'key' => 'fake_jackpot_increment_range_daily',
            'value' => '5,10',
        ]);
    }
}
