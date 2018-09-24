<?php

use App\Models\Gaming\Game;
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
        for ($i = 0; $i < 15; $i++) {
            $game = Game::orderByRaw('RAND()')->first();
            $user = User::orderByRaw('RAND()')->first();
            $win = mt_rand(5, 150);

            DB::table('game_user_winnings')->insert([
                'game_id' => $game->id,
                'user_id' => $user->id,
                'win_amount' => $win,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
