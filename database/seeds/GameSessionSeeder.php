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

        // These tokens are used to make integration tests with Stefan's work
        $tokenMap = [
            1 => '1b4f0e',
            3 => '60303a',
            5 => '111aaa',
            7 => '222bbb',
            13 => '333ccc',
            14 => '444ddd',
            15 => '555eee'
        ];

        foreach ($tokenMap as $gameId => $token) {
            DB::table('game_user_session')->insert([
                'game_id' => $gameId,
                'user_id' => $testUser->id,
                'credits' => 1000000,
                'credits_bonus' => 500000,
                'token' => $token,
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);

            DB::table('game_user_session')->insert([
                'game_id' => $gameId,
                'user_id' => null,
                'credits' => 1000000,
                'credits_bonus' => 500000,
                'token' => "demo_$token",
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now()
            ]);
        }

        DB::table('game_user_session')->insert([
            'game_id' => 999,
            'user_id' => $testUser->id,
            'credits' => 1000000,
            'credits_bonus' => 500000,
            'token' => 'dummy',
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now()
        ]);
    }
}
