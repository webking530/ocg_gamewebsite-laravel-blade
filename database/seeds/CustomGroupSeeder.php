<?php

use App\Models\Gaming\CustomGameGroup;
use Illuminate\Database\Seeder;
use Models\Gaming\Game;

class CustomGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomGameGroup::create([
            'group' => 100,
            'locale' => 'en',
            'name' => 'Christmas',
        ]);

        CustomGameGroup::create([
            'group' => 100,
            'locale' => 'es',
            'name' => 'Navidad',
        ]);

        CustomGameGroup::create([
            'group' => 101,
            'locale' => 'en',
            'name' => 'Summer',
        ]);

        CustomGameGroup::create([
            'group' => 101,
            'locale' => 'es',
            'name' => 'Verano',
        ]);

        (new \Models\Gaming\TournamentService())->createTournament(100, 0, Game::orderByRaw('RAND()')->take(4)->get());
        (new \Models\Gaming\TournamentService())->createTournament(101, 0, Game::orderByRaw('RAND()')->take(4)->get());
    }
}
