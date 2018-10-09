<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyTournamentsTableExtended extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->timestamp('extended_at')->nullable();
            $table->integer('level')->default(0);
        });

        Schema::table('settings', function (Blueprint $table) {
            $table->text('value')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tournaments', function (Blueprint $table) {
            $table->dropColumn('extended_at');
            $table->dropColumn('level');
        });


        Schema::table('settings', function (Blueprint $table) {
            $table->string('value')->change();
        });
    }
}
