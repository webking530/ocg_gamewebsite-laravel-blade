<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTournamentsTableGameidDrop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropForeign('tournaments_game_id_foreign');
            $table->dropColumn('game_id')->unsigned()->nullable();
        });

        Schema::create('tournament_game', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tournament_id')->unsigned()->nullable();
            $table->foreign('tournament_id')->references('id')->on('tournaments');

            $table->integer('game_id')->unsigned()->nullable();
            $table->foreign('game_id')->references('id')->on('games');

            $table->timestamps();
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
