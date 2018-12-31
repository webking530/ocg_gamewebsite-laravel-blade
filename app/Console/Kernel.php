<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\Pricing\ExchangeUpdate::class,
        Commands\Pricing\Notification::class,
        Commands\Lottery\ProcessLottery::class,
        Commands\Lottery\ResetTicketReservations::class,
        Commands\Jackpot\JackpotStats::class,
        Commands\Tournament\ProcessFinishedTournaments::class,
        Commands\Tournament\InitTournaments::class,
        Commands\Tournament\CheckPendingTournaments::class,
        Commands\Tournament\EnrollNewUsersToTournaments::class,
        Commands\Gaming\DistributeGameCash::class,
        Commands\Gaming\CloseDemoSessions::class,
        Commands\Gaming\UpdateRecentWinnersCache::class,
        Commands\Pricing\DCPAbuse::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('pricing:update-exchange-rates')->environments('production')->hourly()->withoutOverlapping();
        $schedule->command('pricing:notification')->environments('production')->hourly()->withoutOverlapping();
        $schedule->command('detect-dcp-abuse')->environments('production')->everyThirtyMinutes()->withoutOverlapping();

        $schedule->command('lottery:process')->environments('production')->everyMinute()->withoutOverlapping();
        $schedule->command('lottery:reset-ticket-reservations')->environments('production')->everyMinute()->withoutOverlapping();

        $schedule->command('tournaments:enroll-new-users')->environments('production')->hourly()->withoutOverlapping();
        $schedule->command('tournaments:check-pending')->environments('production')->everyMinute()->withoutOverlapping();
        $schedule->command('tournaments:process')->environments('production')->everyMinute()->withoutOverlapping();

        $schedule->command('jackpot:process-stats')->environments('production')->daily()->withoutOverlapping();

        $schedule->command('games:distribute-money')->environments('production')->twiceDaily()->withoutOverlapping();
        $schedule->command('demo-sessions:close')->environments('production')->everyMinute()->withoutOverlapping();
        $schedule->command('recent-winners:update-cache')->environments('production')->everyThirtyMinutes()->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
