<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shop_name', 20);
            $table->unsignedBigInteger('area_id');
            //unsignedBigInteger出ないとAreasとうまくつながらない
            //マイナスになる見込みがないものにはUNSIGNEDを付ける
            $table->timestamps();

            $table->foreign('area_id')->references('id')->on('areas');
            //foreign 繋げたいカラム references 繋げるカラム on 繋げるテーブル
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
}
