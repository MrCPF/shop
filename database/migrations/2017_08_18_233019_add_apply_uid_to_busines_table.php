<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddApplyUidToBusinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('busines', function (Blueprint $table) {
            $table->integer('apply_uid');
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
            $table->dropColumn('apply_uid');
        });
    }
}
