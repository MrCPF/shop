<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ausers', function (Blueprint $table) {
            $table->increments('ausers_id');
            $table->string('ausers_name');
            $table->string('ausers_email')->unique();
            $table->string('ausers_password', 60);
            $table->enum('ausers_sex', ['男', '女','保密']);
            $table->tinyInteger('auth');  //0代表普通用户 1代表管理员
            $table->tinyInteger('status');  //0代表启用 1代表禁用
            $table->rememberToken();
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
        Schema::drop('ausers');
    }
}
