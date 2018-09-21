<?php

namespace App\Console\Commands\Jackpot;

use Illuminate\Console\Command;

class JackpotStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jackpot:process-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processes fake jackpot stats to show to users';

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
        $enableFakeJackpot = settings('enable_fake_jackpot') == 'true';

        if ( ! $enableFakeJackpot) {
            return;
        }

        $currentFakeJackpot = (int)settings('fake_jackpot_current');
        $fakeJackpotInterval = explode(',', settings('fake_jackpot_increment_range_daily'));
        $fakeJackpotRandomDailyAmount = mt_rand((int)$fakeJackpotInterval[0], (int)$fakeJackpotInterval[1]);

        $currentFakeJackpot += $fakeJackpotRandomDailyAmount;

        settings('fake_jackpot_current', $currentFakeJackpot);

    }
}
