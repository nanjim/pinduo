<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name','50')->default('');
            $table->tinyInteger('type')->default('1')->comment('1：个人；2：团队');
            $table->string('qq',30)->default('');
            $table->string('weixin',30)->default('');
            $table->integer('income')->default(0);
            $table->text('desc');
            $table->tinyInteger('status')->default(0)->comment('0:未审核;1:审核');
            $table->integer('user_id');
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
        Schema::dropIfExists('teams');
    }
}
