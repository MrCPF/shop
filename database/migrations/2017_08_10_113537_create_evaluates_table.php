<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEvaluatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluates', function (Blueprint $table) {
            $table->increments('eval_id');
            $table->integer('eval_uid');
            $table->integer('eval_gid');
            $table->tinyInteger('eval_level');
            $table->dateTime('eval_time');
            $table->string('eval_content');
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
        Schema::drop('evaluates');
    }
}
