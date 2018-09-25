<?php

use Models\Gaming\Game;
use Models\Gaming\Jackpot;
use Illuminate\Database\Seeder;

class JackpotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = Game::where('has_jackpot', true)->get();

        foreach ($games as $game) {
            $game->credits = mt_rand(2000,15000);
            $game->save();
        }

        Jackpot::create([
            'user_id' => 1,
            'prize' => 5000
        ]);

        Jackpot::create([
            'user_id' => 2,
            'prize' => 23000
        ]);
    }
}
