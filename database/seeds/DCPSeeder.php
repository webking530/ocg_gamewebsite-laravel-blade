<?php

use Illuminate\Database\Seeder;
use Models\Auth\User;
use Models\Pricing\Deposit;

class DCPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $referral = User::find(2);
        $referral->referrer_id = 1;
        $referral->save();

        $referral2 = User::find(3);
        $referral2->referrer_id = 1;
        $referral2->save();

        $referral3 = User::find(4);
        $referral3->referrer_id = 1;
        $referral3->save();

        Deposit::create([
            'credits' => 1000,
            'currency_code' => 'EUR',
            'amount' => 872.3,
            'amount_USD' => 1000,
            'method' => 'temporal',
            'status' => Deposit::STATUS_APPROVED,
            'user_id' => 2,
            'trn' => 'abc123',
            'ip' => '100.0.1.2',
            'approved_at' => \Carbon\Carbon::now(),
        ]);

        Deposit::create([
            'credits' => 1000,
            'currency_code' => 'EUR',
            'amount' => 872.3,
            'amount_USD' => 1000,
            'method' => 'temporal',
            'status' => Deposit::STATUS_REFUNDED,
            'user_id' => 3,
            'trn' => '66a6a',
            'ip' => '222.0.1.2',
            'approved_at' => \Carbon\Carbon::now(),
        ]);

        $usedDeposit = Deposit::create([
            'credits' => 1000,
            'currency_code' => 'EUR',
            'amount' => 872.3,
            'amount_USD' => 1000,
            'method' => 'temporal',
            'status' => Deposit::STATUS_APPROVED,
            'user_id' => 4,
            'trn' => 'a1323bc123',
            'ip' => '100.0.1.2',
            'approved_at' => \Carbon\Carbon::now(),
        ]);

        Deposit::create([
            'credits' => 1000,
            'currency_code' => 'EUR',
            'amount' => 872.3,
            'amount_USD' => 1000,
            'method' => 'temporal',
            'status' => Deposit::STATUS_APPROVED,
            'user_id' => 1,
            'trn' => 'abc1zzzs23',
            'ip' => '100.0.1.2',
            'approved_at' => \Carbon\Carbon::now(),
            'discount_deposit_id' => $usedDeposit->id,
            'discount_amount' => $usedDeposit->calculated_discount,
            'discount_amount_USD' => $usedDeposit->calculated_discount_usd
        ]);
    }
}
