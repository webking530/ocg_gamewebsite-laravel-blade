<?php
/**
 * Created by PhpStorm.
 * User: alexplay
 * Date: 30/09/18
 * Time: 03:27 PM
 */

namespace App\Console\Commands\Tournament;

use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Models\Auth\User;
use Models\Gaming\Tournament;
use Models\Gaming\TournamentService;

class ProcessFinishedTournaments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tournaments:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes finished tournaments and pay the winning users their prizes';

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
        $tournaments =
            Tournament::where('status', Tournament::STATUS_PENDING)
            ->where('date_to', '<', Carbon::now())->get();

        /**
         * @var Tournament $tournament
         */
        foreach ($tournaments as $tournament) {
            DB::beginTransaction();

            $tournament->status = Tournament::STATUS_FINISHED;
            $tournament->save();

            // Get the 3 winning places
            $users = $tournament->users()->take(3)->get();

            /**
             * @var User $user
             */
            foreach ($users as $place => $user) {
                $user->credits += (int)$tournament->prizes[$place];
                $user->save();
            }

            (new TournamentService())->createTournamentFromPrevious($tournament);

            DB::commit();
        }
    }
}