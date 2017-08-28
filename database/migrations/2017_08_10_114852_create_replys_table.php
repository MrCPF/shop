<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReplysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replys', function (Blueprint $table) {
            $table->increments('replys_id');
            $table->integer('replys_bid');
            $table->integer('replys_uid');
            $table->integer('replys_eid');
            $table->dateTime('replys_time');
            $table->string('replys_content');
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
        Schema::drop('replys');
    }
}
