<?php

use App\Console\Commands\Gaming\UpdateRecentWinnersCache;
use Models\Gaming\Game;
use Illuminate\Database\Seeder;
use Models\Auth\User;

class GameUserWinningsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            $game = Game::orderByRaw('RAND()')->first();
            $user = User::orderByRaw('RAND()')->first();
            $win = mt_rand(5, 150);

            DB::table('game_user_winnings')->insert([
                'game_id' => $game->id,
                'user_id' => $user->id,
                'win_amount' => $win,
                'lose_amount' => 0,
                'token' => substr(md5($user->id), 0, 6),
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }

        UpdateRecentWinnersCache::executeCommand();
    }
}
