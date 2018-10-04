<?php

namespace App\Console\Commands\Lottery;

use Models\Gaming\Lottery;
use Models\Gaming\LotteryTicket;
use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;

class ProcessLottery extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'lottery:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process pending lotteries, change their status to active and select a random winning ticket';

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
        $this->processPendingLotteries();
        $this->processActiveLotteries();
    }

    /**
     * When the lottery time comes, choose a random winning ticket and pay the prize to the user
     */
    private function processPendingLotteries() {
        $now = Carbon::now();
        $lotteries = Lottery::whereStatus(Lottery::STATUS_PENDING)->get();

        /**
         * @var Lottery $lottery
         */
        foreach ($lotteries as $lottery) {
            if ($now->timestamp < $lottery->date_begin->timestamp) {
                continue;
            }

            DB::beginTransaction();

            $lottery->status = Lottery::STATUS_ACTIVE;
            $lottery->save();

            /**
             * @var LotteryTicket $ticket
             */
            $ticket = $lottery->tickets()->whereNotNull('user_id')->orderByRaw('RAND()')->first();
            $ticket->winner = true;
            $ticket->save();

            // after selecting the winning ticket, add the lottery prize to the user balance
            $ticket->user->credits += $lottery->getPotSize();
            $ticket->user->save();

            DB::commit();
        }
    }

    /**
     * Lotteries stay active for 24 hours, then they are finalized
     */
    private function processActiveLotteries() {
        $now = Carbon::now();
        $lotteries = Lottery::whereStatus(Lottery::STATUS_ACTIVE)->get();

        /**
         * @var Lottery $lottery
         */
        foreach ($lotteries as $lottery) {
            if ($now->diffInHours($lottery->date_begin, false) < 24) {
                continue;
            }

            $lottery->status = Lottery::STATUS_FINALIZED;
            $lottery->save();
        }
    }
}
