<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLanguagesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->string('code', 2)->primary();
            $table->timestamps();
        });

        Schema::create('countries', function (Blueprint $table) {
            $table->string('code', 2)->primary();

            $table->string('currency_code', 3);
            $table->foreign('currency_code')->references('code')->on('currencies');

            $table->string('pricing_currency', 3)->nullable();
            $table->foreign('pricing_currency')->references('code')->on('currencies');

            $table->string('locale', 2);
            $table->foreign('locale')->references('code')->on('languages');

            $table->string('capital_timezone');
            $table->integer('enabled')->default(1);

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
        Schema::dropIfExists('countries');
        Schema::dropIfExists('languages');
    }
}
