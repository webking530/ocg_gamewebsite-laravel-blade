<?php

namespace App\Console\Commands\Gaming;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Models\Gaming\GameUserSession;

class CloseDemoSessions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo-sessions:close';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Closes demo sessions after a specified time';

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
        $now = Carbon::now();

        GameUserSession::where('token', 'like', 'demo_%')
        ->where('created_at', '<=', $now->subMinutes(GameUserSession::DEMO_SESSION_EXPIRATION_MINUTES))
        ->delete();
    }
}
