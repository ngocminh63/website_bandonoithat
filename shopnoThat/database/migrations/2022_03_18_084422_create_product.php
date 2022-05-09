<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('pro_id');
            $table->string('pro_name');
            $table->integer('cate_id');
            $table->integer('brand_id');
            $table->integer('room_id');
            $table->text('pro_desc');
            $table->string('pro_price');
            $table->string('pro_img');
            $table->string('pro_size');
            $table->string('pro_color');
            $table->string('pro_material');
            $table->integer('pro_status');
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
        Schema::dropIfExists('product');
    }
}
