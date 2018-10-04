<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyLotteryTicketTableReserved extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lottery_ticket', function (Blueprint $table) {
            $table->integer('reserver_id')->unsigned()->nullable();
            $table->foreign('reserver_id')->references('id')->on('users');

            $table->timestamp('reserved_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
