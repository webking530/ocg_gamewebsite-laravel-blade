<?php

namespace App\Console\Commands\Lottery;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Models\Gaming\Lottery;
use Models\Gaming\LotteryTicket;

class ResetTicketReservations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lottery:reset-ticket-reservations';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check reserved tickets and clear the reservation on those that have more than X minutes';

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
        LotteryTicket::whereHas('lottery', function ($q) {
            $q->where('status', Lottery::STATUS_PENDING);
        })
        ->whereNull('user_id')
        ->whereNotNull('reserver_id')
        ->where('reserved_at', '<=', Carbon::now()->subMinutes(LotteryTicket::RESERVATION_TIME_MINUTES))
        ->update([
            'reserver_id' => null,
            'reserved_at' => null
        ]);
    }
}
