<?php

namespace App\Console\Commands\Tournament;

use Illuminate\Console\Command;
use Models\Gaming\TournamentService;

class InitTournaments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tournaments:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates the initial tournaments when the system launches';

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
        (new TournamentService())->createInitialTournaments();
    }
}
