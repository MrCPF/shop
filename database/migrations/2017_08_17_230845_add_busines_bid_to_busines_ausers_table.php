<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinesBidToBusinesAusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('busines_ausers', function (Blueprint $table) {
            $table->integer('busines_bid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('busines_ausers', function (Blueprint $table) {
            $table->dropColumn('busines_bid');
        });
    }
}
