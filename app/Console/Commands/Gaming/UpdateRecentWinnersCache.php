<?php

namespace App\Console\Commands\Gaming;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Models\Gaming\GameUserWinning;
use Models\Gaming\GameUserWinningCache;

class UpdateRecentWinnersCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'recent-winners:update-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates recent winners based on game_user_winnings table';

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
        self::executeCommand();
    }

    public static function executeCommand() {
        GameUserWinningCache::truncate();

        $winners = GameUserWinning::whereRaw('win_amount > lose_amount')
            ->where('created_at', '>=', Carbon::now()->subHours(24))
            ->orderByRaw('win_amount - lose_amount DESC')
            ->take(16)
            ->get();

        if ($winners->count() < 4) {
            $winners = GameUserWinning::whereRaw('win_amount > lose_amount')
                ->orderByRaw('win_amount - lose_amount DESC')
                ->take(16)
                ->get();
        }

        foreach ($winners as $winner) {
            GameUserWinningCache::create([
                'game_id' => $winner->game_id,
                'user_id' => $winner->user_id,
                'net_win' => $winner->net_win
            ]);
        }
    }
}
