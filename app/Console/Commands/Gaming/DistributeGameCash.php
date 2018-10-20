<?php

namespace App\Console\Commands\Gaming;

use Illuminate\Console\Command;
use Models\Gaming\Game;

class DistributeGameCash extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'games:distribute-money';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Distribute money between games of the same group to prevent having certain games with no money for too long.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle()
    {
        foreach (Game::GROUP_LIST as $group) {
            $games = Game::enabled()->where('group', $group)->get();
            $totalCredits = $games->sum('credits');
            $totalPopularity = $games->sum('sessions_opened');

            foreach ($games as $game) {
                $currentGamePopularity = $game->sessions_opened / $totalPopularity;
                $creditsToShare = $totalCredits * $currentGamePopularity;

                $game->credits = $creditsToShare;
                $game->save();
            }
        }
    }
}
