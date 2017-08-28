<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusentryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('busentry', function (Blueprint $table) {
            $table->increments('busentry_id');
            $table->string('busentry_name');
            $table->string('busentry_desc', 255);
            $table->string('busentry_address');
            $table->string('busentry_pic');
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
        Schema::drop('busentry');
    }
}
