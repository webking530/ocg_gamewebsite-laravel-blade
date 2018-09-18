<?php

use App\Models\Gaming\Lottery;
use App\Models\Gaming\LotteryTicket;
use Illuminate\Database\Seeder;

class LotterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lotteryLow = Lottery::create([
            'prize' => 1500,
            'date_open' => \Carbon\Carbon::now(),
            'date_close' => \Carbon\Carbon::now()->addDays(20),
            'date_begin' => \Carbon\Carbon::now()->addDays(20),
            'status' => Lottery::STATUS_PENDING,
            'type' => Lottery::TYPE_LOW_STAKE,
            'ticket_price' => 10
        ]);

        $lotteryMid = Lottery::create([
            'prize' => 17000,
            'date_open' => \Carbon\Carbon::now()->subDays(10),
            'date_close' => \Carbon\Carbon::now()->subDays(1),
            'date_begin' => \Carbon\Carbon::now(),
            'status' => Lottery::STATUS_ACTIVE,
            'type' => Lottery::TYPE_MID_STAKE,
            'ticket_price' => 100
        ]);

        LotteryTicket::create([
            'lottery_id' => $lotteryLow->id,
            'user_id' => 1,
            'numbers' => [10,12,5,7,20,33],
            'winner' => false
        ]);
        LotteryTicket::create([
            'lottery_id' => $lotteryLow->id,
            'user_id' => 2,
            'numbers' => [11,7,9,10,20,14],
            'winner' => false
        ]);
        LotteryTicket::create([
            'lottery_id' => $lotteryLow->id,
            'user_id' => 3,
            'numbers' => [1,2,3,4,5,6],
            'winner' => false
        ]);
        LotteryTicket::create([
            'lottery_id' => $lotteryLow->id,
            'user_id' => 4,
            'numbers' => [32,30,28,26,24,22],
            'winner' => false
        ]);
        LotteryTicket::create([
            'lottery_id' => $lotteryLow->id,
            'user_id' => 5,
            'numbers' => [12,14,16,18,20,22],
            'winner' => false
        ]);

        LotteryTicket::create([
            'lottery_id' => $lotteryMid->id,
            'user_id' => 1,
            'numbers' => [2,4,6,8,10,12],
            'winner' => true
        ]);
        LotteryTicket::create([
            'lottery_id' => $lotteryMid->id,
            'user_id' => 2,
            'numbers' => [1,3,9,12,15,17],
            'winner' => false
        ]);
        LotteryTicket::create([
            'lottery_id' => $lotteryMid->id,
            'user_id' => 3,
            'numbers' => [3,6,9,12,15,18],
            'winner' => false
        ]);
        LotteryTicket::create([
            'lottery_id' => $lotteryMid->id,
            'user_id' => 4,
            'numbers' => [20,21,22,23,24,25],
            'winner' => false
        ]);
    }
}
