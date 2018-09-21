<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('goods', function (Blueprint $table) {
            $table->string('goods_id')->after('title');
            $table->integer('user_id')->after('goods_id');
            $table->smallInteger('status')->after('cat_id')->default(0);
            $table->unsignedTinyInteger('type')->after('status')->comment('0：接口商品；1：商家商品')->default(0);
            $table->tinyInteger('onsale')->after('status')->comment('0：下架；1：上架')->default(1);
            $table->decimal('commission')->after('rate')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('goods', function (Blueprint $table) {
           $table->dropColumn('goods_id');
           $table->dropColumn('user_id');
           $table->dropColumn('status');
        });
    }
}
