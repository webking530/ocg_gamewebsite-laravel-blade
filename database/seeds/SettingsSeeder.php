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
            'key' => 'real_jackpot_current',
            'value' => '0',
        ]);

        Models\Setting\Setting::create([
            'key' => 'jackpot_min_value',
            'value' => '0',
        ]);

        Models\Setting\Setting::create([
            'key' => 'jackpot_max_value',
            'value' => '10000',
        ]);

        Models\Setting\Setting::create([
            'key' => 'jackpot_bet_coefficient',
            'value' => '0.01',
        ]);

        Models\Setting\Setting::create([
            'key' => 'jackpot_min_bet_usd',
            'value' => '1',
        ]);


        Models\Setting\Setting::create([
            'key' => 'fake_jackpot_increment_range_daily',
            'value' => '5,10',
        ]);

        Models\Setting\Setting::create([
            'key' => 'tournament_base_days',
            'value' => '33',
        ]);

        Models\Setting\Setting::create([
            'key' => 'tournament_tpa_levels',
            'value' => json_encode([
                [
                    'tpa' => 8800,
                    'prizes' => [200,140,100]
                ],
                [
                    'tpa' => 22000,
                    'prizes' => [500,350,250]
                ],
                [
                    'tpa' => 44000,
                    'prizes' => [1000,700,500]
                ],
                [
                    'tpa' => 110000,
                    'prizes' => [2500,1750,1250]
                ],
                [
                    'tpa' => 220000,
                    'prizes' => [5000,3500,2500]
                ],
                [
                    'tpa' => 440000,
                    'prizes' => [10000,7000,5000]
                ],
            ]),
        ]);

        Models\Setting\Setting::create([
            'key' => 'enable_social_register',
            'value' => 'true',
        ]);

        Models\Setting\Setting::create([
            'key' => 'noreply_email',
            'value' => 'noreply@ocgcasino.com',
        ]);

        Models\Setting\Setting::create([
            'key' => 'admin_email',
            'value' => 'info@ocgcasino.com',
        ]);
    }
}
