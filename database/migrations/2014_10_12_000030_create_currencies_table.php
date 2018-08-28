<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCurrenciesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->string('code', 3)->primary();
            $table->string('symbol', 3);
            $table->timestamps();
        });

        Schema::create('exchange', function (Blueprint $table) {
            $table->string('from', 3);
            $table->foreign('from')->references('code')->on('currencies');

            $table->string('to', 3);
            $table->foreign('to')->references('code')->on('currencies');

            $table->double('rate', 15, 6);
            $table->timestamps();

            $table->primary(['from', 'to']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchange');
        Schema::dropIfExists('currencies');
    }
}
