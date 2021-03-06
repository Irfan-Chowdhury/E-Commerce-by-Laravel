<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('payment_id')->nullable(); 
            $table->string('payment_type')->nullable(); 
            $table->string('paying_amount')->nullable(); 
            $table->string('blnc_transection')->nullable(); 
            $table->string('stripe_order_id')->nullable();
            $table->string('coupon')->nullable(); 
            $table->integer('quantity')->nullable(); 
            $table->string('subtotal')->nullable(); 
            $table->string('shipping_charge')->nullable();  
            $table->integer('vat')->nullable(); 
            $table->string('total')->nullable(); 
            $table->integer('status')->nullable()->default(0); 
            $table->integer('return_order')->nullable()->default(0); 
            $table->string('month')->nullable();
            $table->string('date')->nullable();
            $table->string('year')->nullable();
            $table->string('status_code')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
