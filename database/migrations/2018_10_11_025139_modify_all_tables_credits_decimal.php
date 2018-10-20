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
            $table->decimal('credits', 18, 2)->change();
        });
        Schema::table('games', function (Blueprint $table) {
            $table->decimal('credits', 18, 2)->change();
        });
        Schema::table('game_user_bets_open', function (Blueprint $table) {
            $table->decimal('bet_amount', 18, 2)->change();
        });
        Schema::table('game_user_session', function (Blueprint $table) {
            $table->decimal('credits', 18, 2)->change();
        });
        Schema::table('game_user_winnings', function (Blueprint $table) {
            $table->decimal('win_amount', 18, 2)->change();
        });
        Schema::table('jackpots', function (Blueprint $table) {
            $table->decimal('prize', 18, 2)->change();
        });
        Schema::table('tournament_user', function (Blueprint $table) {
            $table->decimal('total_win', 18, 2)->change();
            $table->decimal('total_lose', 18, 2)->change();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('credits', 18, 2)->change();
        });
        Schema::table('withdrawals', function (Blueprint $table) {
            $table->decimal('credits', 18, 2)->change();
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
