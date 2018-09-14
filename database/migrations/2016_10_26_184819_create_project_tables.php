<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('credits');
            $table->string('currency_code', 3);
            $table->foreign('currency_code')->references('code')->on('currencies');
            $table->decimal('amount');
            $table->decimal('amount_USD');
            $table->string('method');
            $table->integer('status');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('withdrawals', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('credits');
            $table->string('currency_code', 3);
            $table->foreign('currency_code')->references('code')->on('currencies');
            $table->decimal('amount');
            $table->decimal('amount_USD');
            $table->string('method');
            $table->integer('status');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('badges', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('description');
            $table->string('image_url');
            $table->integer('relevance');

            $table->timestamps();
        });

        Schema::create('badge_user', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('badge_id')->unsigned()->nullable();
            $table->foreign('badge_id')->references('id')->on('badges');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });

        Schema::create('bonuses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type');
            $table->decimal('prize');
            $table->timestamps();
        });

        Schema::create('news', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('content');
            $table->integer('order');
            $table->timestamp('date_from')->nullable();
            $table->timestamp('date_to')->nullable();
            $table->timestamps();
        });

        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('icon_url');
            $table->integer('credits');
            $table->integer('type');
            $table->integer('group');
            $table->boolean('has_jackpot');
            $table->integer('jackpot_size');
            $table->text('settings');
            /*$table->integer('jackpot_multiplier')->nullable();
            $table->decimal('jackpot_chance_percent')->nullable();
            $table->decimal('min_bet');
            $table->decimal('max_bet');
            $table->decimal('interval_bet')->nullable();*/
            $table->boolean('allow_tournaments')->default(1);
            $table->boolean('enabled')->default(1);
            $table->timestamps();
        });

        Schema::create('lotteries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('prize');
            $table->timestamp('date_open')->nullable();
            $table->timestamp('date_close')->nullable();
            $table->timestamp('date_begin')->nullable();
            $table->integer('status');
            $table->integer('type');
            $table->integer('ticket_price');
            $table->string('country_code', 2)->nullable();
            $table->foreign('country_code')->references('code')->on('countries');
            $table->timestamps();
        });

        Schema::create('lottery_ticket', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('lottery_id')->unsigned()->nullable();
            $table->foreign('lottery_id')->references('id')->on('lotteries');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('numbers');
            $table->boolean('winner')->default(0);

            $table->timestamps();
        });

        Schema::create('tournaments', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('game_id')->unsigned()->nullable();
            $table->foreign('game_id')->references('id')->on('games');

            $table->integer('group')->unsigned()->nullable();
            $table->string('prizes');
            $table->timestamp('date_from')->nullable();
            $table->timestamp('date_to')->nullable();
            $table->timestamps();
        });

        Schema::create('tournament_user', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('tournament_id')->unsigned()->nullable();
            $table->foreign('tournament_id')->references('id')->on('tournaments');

            $table->integer('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');

            $table->integer('total_win');

            $table->timestamps();
        });

        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('value');
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
        Schema::dropIfExists('settings');
        Schema::dropIfExists('tournament_user');
        Schema::dropIfExists('tournaments');
        Schema::dropIfExists('lottery_ticket');
        Schema::dropIfExists('lotteries');
        Schema::dropIfExists('games');
        Schema::dropIfExists('news');
        Schema::dropIfExists('bonuses');
        Schema::dropIfExists('badge_user');
        Schema::dropIfExists('badges');
        Schema::dropIfExists('withdrawals');
        Schema::dropIfExists('deposits');
    }
}
