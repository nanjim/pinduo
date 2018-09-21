<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOuterGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outer_goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->bigInteger('goods_id');
            $table->integer('user_id');
            $table->integer('cat_id');
            $table->tinyInteger('status')->default(0);
            $table->tinyInteger('onsale')->comment('0：下架；1：上架')->default(1);
            $table->tinyInteger('type')->comment('0：接口商品；1：商家商品')->default(0);
            $table->decimal('score','5','2')->nullable();
            $table->integer('sale_num')->nullable();
            $table->decimal('origin_price','10','2');
            $table->decimal('coupon_amount','10','2')->nullable();
            $table->decimal('after_price','10','2');
            $table->integer('coupon_num')->nullable();
            $table->integer('coupon_remain')->nullable();
            $table->integer('rate')->nullable();
            $table->decimal('commission')->default(0);
            $table->string('start_time');
            $table->string('end_time');
            $table->text('copy_text')->nullable();
            $table->text('imgs')->nullable();
            $table->string('main_img')->nullable();
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
        Schema::dropIfExists('outer_goods');
    }
}
