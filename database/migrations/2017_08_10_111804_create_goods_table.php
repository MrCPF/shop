<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->increments('goods_id');
            $table->integer('cats_id');
            $table->integer('goods_bid');
            $table->string('goods_name',30);
            $table->float('goods_price');
            $table->float('goods_sprice');
            $table->integer('goods_number');
            $table->string('goods_detail');
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
        Schema::drop('goods');
    }
}
