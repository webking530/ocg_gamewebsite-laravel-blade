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
        $this->call(BaseSeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(BonusSeeder::class);
        $this->call(GamesSeeder::class);
        $this->call(TournamentSeeder::class);
        $this->call(BadgeSeeder::class);
        $this->call(LotterySeeder::class);
    }
}
