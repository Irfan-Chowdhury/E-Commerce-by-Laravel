<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('product_name')->nullable(); //should avoid this because I have already used product_id
            $table->string('color')->nullable(); //don't panic with product_id, it's corrrect.
            $table->string('size')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('singleprice')->nullable(); // we use "Cart" that's why use string
            $table->string('totalprice')->nullable();  // we use "Cart" that's why use string
            $table->timestamps();


            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
}
