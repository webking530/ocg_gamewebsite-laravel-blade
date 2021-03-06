<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGameUserSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('game_user_session', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('game_id')->unsigned()->nullable();
            $table->foreign('game_id')->references('id')->on('games');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->decimal('credits_deposited', 18, 2);
            $table->integer('credits');
            $table->decimal('credits_bonus', 18, 2);

            $table->timestamps();
        });

        Schema::table('games', function (Blueprint $table) {
            $table->integer('sessions_opened', false, true)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('game_user_session');

        Schema::table('games', function (Blueprint $table) {
            $table->dropColumn('sessions_opened');
        });
    }
}
