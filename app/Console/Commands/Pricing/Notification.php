<?php namespace App\Console\Commands\Pricing;

use Carbon\Carbon;
use DB;
use Illuminate\Console\Command;
use Models\Mailing\MailingService;
use Models\Pricing\Exchange;


class Notification extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pricing:notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sender Admin Notification If Currency Exchange fails.';
    /**
     * @type MailingService
     */
    private $mailer;

    public function __construct(MailingService $mailer)
    {
        parent::__construct();
        $this->mailer = $mailer;
    }

    public function handle()
    {
        if (Exchange::where('updated_at', '<', Carbon::now()->subHour())->exists()) {
            $subject = '[WARNING] Currency Exchange Updater Not Working';
            $message = "Currency Exchange Updater is not working properly or at all.<br />You will keep getting this message automatically once an hour until the issue is fixed.";
            $this->mailer->from()->system()->to()->admin()->cc()->developer()->message($message)->subject($subject)->send();
        }

    }

}
