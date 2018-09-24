<?php

use App\Models\Gaming\Game;
use Illuminate\Database\Seeder;
use Models\Auth\User;

class GameSessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            $games = Game::orderByRaw('RAND()')->take(3)->get();

            foreach ($games as $game) {
                DB::table('game_user_session')->insert([
                    'game_id' => $game->id,
                    'user_id' => $user->id,
                    'credits' => mt_rand(10, 300),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            }
        }
    }
}
