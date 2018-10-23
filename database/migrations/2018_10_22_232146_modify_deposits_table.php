<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->string('trn');
            $table->string('ip');
            $table->string('reject_reason')->nullable();
            $table->timestamp('approved_at')->nullable();

            $table->integer('bank_account_id')->unsigned()->nullable();
            $table->foreign('bank_account_id')->references('id')->on('bank_accounts');

            $table->integer('discount_deposit_id')->unsigned()->nullable();
            $table->foreign('discount_deposit_id')->references('id')->on('deposits');

            $table->decimal('discount_amount')->nullable();
            $table->decimal('discount_amount_USD')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->boolean('dcp_suspended')->default(false);
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
