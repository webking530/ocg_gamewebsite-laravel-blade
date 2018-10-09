<?php

namespace App\Console\Commands\Tournament;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Models\Gaming\Tournament;

class CheckPendingTournaments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tournaments:check-pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Checks running tournaments' Total Play Amount (TPA) for time extension 5 minutes before ending.";

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
        $tpaLevels = json_decode(settings('tournament_tpa_levels'));
        $minutesBeforeEnding = 5;

        // Check tournaments X minutes before ending and see if they meet the TPA
        $tournaments = Tournament::where('status', Tournament::STATUS_PENDING)
                        ->where('date_to', '<=', Carbon::now()->addMinutes($minutesBeforeEnding))
                        ->get();

        /**
         * @var Tournament $tournament
         */
        foreach ($tournaments as $tournament) {
            if ($tournament->getTotalPlayAmount() < $tpaLevels[$tournament->level]['tpa']) {
                $tournament->date_to = $tournament->date_to->addDays(settings('tournament_base_days'));
                $tournament->extended_at = Carbon::now();
                $tournament->save();
            }
        }
    }
}
