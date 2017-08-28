<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGoodsTitleToGoodsImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods_imgs', function (Blueprint $table) {
            $table->string('goods_title',30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods_imgs', function (Blueprint $table) {
            $table->dropColumn('goods_title');
        });
    }
}
