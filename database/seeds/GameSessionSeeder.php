<?php

use Models\Gaming\Game;
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
        $users = User::where('id', '!=', 2)->get();

        foreach ($users as $user) {
            $games = Game::orderByRaw('RAND()')->take(3)->get();

            foreach ($games as $game) {
                DB::table('game_user_session')->insert([
                    'game_id' => $game->id,
                    'user_id' => $user->id,
                    'credits' => mt_rand(10, 300),
                    'credits_bonus' => mt_rand(10, 50),
                    'token' => substr(uniqid(), 0, 6),
                    'created_at' => \Carbon\Carbon::now(),
                    'updated_at' => \Carbon\Carbon::now()
                ]);
            }
        }

        $testUser = User::find(2);

        DB::table('game_user_session')->insert([
            'game_id' => 1,
            'user_id' => $testUser->id,
            'credits' => 1000000,
            'credits_bonus' => 500000,
            'token' => '1b4f0e',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);

        DB::table('game_user_session')->insert([
            'game_id' => 3,
            'user_id' => $testUser->id,
            'credits' => 1000000,
            'credits_bonus' => 500000,
            'token' => '60303a',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
