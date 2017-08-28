<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinesAusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('busines_ausers', function (Blueprint $table) {
            $table->increments('busines_aid');
            $table->string('busines_aname');
            $table->string('busines_apassword', 60);
            $table->tinyInteger('busines_sex');
            $table->tinyInteger('busines_auth')->default(0);
            $table->string('busines_apic');
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
        Schema::drop('busines_ausers');
    }
}
