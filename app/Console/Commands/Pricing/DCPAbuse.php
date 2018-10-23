<?php

namespace App\Console\Commands\Pricing;

use Illuminate\Console\Command;
use Models\Auth\User;

class DCPAbuse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'detect-dcp-abuse';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Detects users with suspicious behaviour in DCP.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $ret = '';
        $users = User::where('dcp_suspended', false)->has('referrals')->get();

        /**
         * @var User $user
         */
        foreach ($users as $user) {
            $referralsWithPayments = $user->referrals()->whereHas('deposits', function ($q) {
                $q->approved();
            })->get();

            $referralsCount = $referralsWithPayments->count();
            $referralsWithOnePayment = array();

            /**
             * @var User $referral
             */
            foreach ($referralsWithPayments as $referral) {
                $deposits = $referral->deposits()->approved()->oldest()->get();

                if ($deposits->count() == 1) {
                    $referralsWithOnePayment[] = $referral;
                } else {
                    if ($deposits[1]->amount_USD <= $deposits[0]->amount_USD * 0.1) {
                        $referralsWithOnePayment[] = $referral;
                    }
                }
            }

            $referralsWithOnePaymentCount = count($referralsWithOnePayment);

            if ($referralsWithOnePaymentCount > 2 && bccomp(round($referralsWithOnePaymentCount / $referralsCount, 2), 0.5, 2) >= 1) {
                $ret .= "User {$user->nickname} meets the first condition." . PHP_EOL;

                $referralsWithRefunds = 0;

                foreach ($referralsWithOnePayment as $referral) {
                    $refunds = $referral->deposits()->refunded()->oldest()->exists();

                    if ($refunds) {
                        $referralsWithRefunds++;
                    }
                }

                if (bccomp(round($referralsWithRefunds / $referralsWithOnePaymentCount, 2), 0.4, 2) >= 1) {
                    $ret .= "Suspended user {$user->nickname}" . PHP_EOL;
                    $this->suspendUser($user);
                }
            }

            if ($referralsWithOnePaymentCount == 2) {
                $referralsWithRefundsAndCreditDiscountUsed = 0;

                foreach ($referralsWithOnePayment as $referral) {
                    $refunds = $referral->deposits()->refunded()->oldest()->exists();

                    if ($refunds && $referral->first_approved_deposit->discountUsed()) {
                        $referralsWithRefundsAndCreditDiscountUsed++;
                    }
                }

                if ($referralsWithRefundsAndCreditDiscountUsed == 2) {
                    $ret .= "Suspended user {$user->nickname}" . PHP_EOL;
                    $this->suspendUser($user);
                }
            }
        }

        $this->info($ret);
    }

    private function suspendUser(User $user) {
        $user->dcp_suspended = true;
        $user->save();
    }
}
