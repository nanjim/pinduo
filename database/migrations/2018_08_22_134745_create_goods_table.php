<?php

use Illuminate\Support\Facades\Schema;
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
            $table->increments('id');
            $table->string('title');
            $table->integer('cat_id');
            $table->decimal('score','5','2')->nullable();
            $table->integer('sale_num');
            $table->decimal('origin_price','10','2');
            $table->decimal('after_price','10','2');
            $table->decimal('coupon_amount','10','2');
            $table->integer('coupon_num');
            $table->integer('coupon_remain');
            $table->integer('rate');
            $table->string('start_time');
            $table->string('end_time');
            $table->text('copy_text');
            $table->text('imgs');
            $table->string('main_img');
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
        Schema::dropIfExists('goods');
    }
}
