<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBusinesMobileToBusinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('busines', function (Blueprint $table) {
            $table->string('busines_mobile',15);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('busines', function (Blueprint $table) {
            $table->dropColumn('busines_mobile');
        });
    }
}
