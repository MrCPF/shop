<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('busines', function (Blueprint $table) {
            $table->increments('busines_id');
            $table->string('busines_name');
            $table->string('busines_desc', 255);
            $table->tinyInteger('busines_level');
            $table->string('busines_address');
            $table->integer('busines_collect_num');
            $table->string('busines_pic');
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
        Schema::drop('busines');
    }
}
