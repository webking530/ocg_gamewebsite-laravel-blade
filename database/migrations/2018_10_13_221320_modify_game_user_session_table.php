<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyGameUserSessionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('game_user_session', function (Blueprint $table) {
            $table->string('token', 11)->nullable();
            $table->text('extra')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_user_session', function (Blueprint $table) {
            $table->dropColumn('token');
            $table->dropColumn('freespins');
        });
    }
}
