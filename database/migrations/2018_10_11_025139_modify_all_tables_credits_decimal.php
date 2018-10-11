<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyAllTablesCreditsDecimal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->decimal('credits')->change();
        });
        Schema::table('games', function (Blueprint $table) {
            $table->decimal('credits')->change();
        });
        Schema::table('game_user_bets_open', function (Blueprint $table) {
            $table->decimal('bet_amount')->change();
        });
        Schema::table('game_user_session', function (Blueprint $table) {
            $table->decimal('credits')->change();
        });
        Schema::table('game_user_winnings', function (Blueprint $table) {
            $table->decimal('win_amount')->change();
        });
        Schema::table('jackpots', function (Blueprint $table) {
            $table->decimal('prize')->change();
        });
        Schema::table('tournament_user', function (Blueprint $table) {
            $table->decimal('total_win')->change();
            $table->decimal('total_lose')->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('credits')->change();
        });
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->decimal('credits')->change();
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
