<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nickname', 20)->unique();
            $table->string('name');
            $table->string('lastname');
            $table->string('gender', 1);
            $table->bigInteger('mobile_number');
            $table->string('email', 40)->unique();
            $table->string('password');
            $table->string('avatar_url');
            $table->integer('credits');
            $table->decimal('credits_bonus', 18, 2);

            $table->string('country_code', 2);
            $table->foreign('country_code')->references('code')->on('countries');

            $table->string('currency_code', 3);
            $table->foreign('currency_code')->references('code')->on('currencies');

            $table->date('birthdate')->nullable();
            $table->string('verification_pin', 6);
            $table->integer('low_balance_threshold');

            $table->integer('referrer_id')->unsigned()->nullable();
            $table->foreign('referrer_id')->references('id')->on('users');

            $table->integer('role');

            $table->string('locale', 2);
            $table->foreign('locale')->references('code')->on('languages');

            $table->string('locale_translator', 2)->nullable();
            $table->foreign('locale_translator')->references('code')->on('languages');

            $table->boolean('verified_identification');
            $table->boolean('notifications');
            $table->integer('lottery_sms_notification_minutes');

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('account_holder');
            $table->string('bank');
            $table->string('number');
            $table->string('iban')->nullable();
            $table->string('swift');
            $table->string('country_code', 2);
            $table->foreign('country_code')->references('code')->on('countries');
            $table->timestamp('deleted_at')->nullable();
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
        Schema::dropIfExists('bank_accounts');
        Schema::dropIfExists('users');
    }
}
