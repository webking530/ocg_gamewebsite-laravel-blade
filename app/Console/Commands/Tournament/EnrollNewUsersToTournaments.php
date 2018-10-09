<?php

namespace App\Console\Commands\Tournament;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Models\Auth\User;
use Models\Gaming\Tournament;
use Models\Gaming\TournamentService;

class EnrollNewUsersToTournaments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tournaments:enroll-new-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically enrolls all new users that meet the requirements to enter a tournament. Until X days before it ends';

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
        $daysBeforeEnding = 7;

        $tournaments = Tournament::where('status', Tournament::STATUS_PENDING)
            ->where('date_to', '>', Carbon::now()->addDays($daysBeforeEnding))
            ->get();

        foreach ($tournaments as $tournament) {
            (new TournamentService())->enrollNewUsers($tournament);
        }
    }
}
