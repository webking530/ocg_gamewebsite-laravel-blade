<?php

use Models\Gaming\Game;
use Illuminate\Database\Seeder;

class GamePopularitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = Game::all();

        foreach ($games as $game) {
            $randomSessions = mt_rand(5, 500);

            $game->sessions_opened = $randomSessions;
            $game->save();
        }
    }
}
