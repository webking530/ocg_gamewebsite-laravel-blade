<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SettingsSeeder::class);
        $this->call(BaseSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(BonusSeeder::class);
        $this->call(GamesSeeder::class);
        $this->call(UserAndTournamentSeeder::class);
        $this->call(BadgeSeeder::class);
        $this->call(LotterySeeder::class);
        $this->call(GamePopularitySeeder::class);
        $this->call(JackpotSeeder::class);
        $this->call(GameUserWinningsSeeder::class);
        $this->call(GameSessionSeeder::class);
        $this->call(ExchangeRatesSeeder::class);
        $this->call(CustomGroupSeeder::class);
    }
}
