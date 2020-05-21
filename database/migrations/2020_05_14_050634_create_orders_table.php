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
            $table->integer('coupon')->nullable(); 
            $table->integer('quantity')->nullable(); 
            $table->string('subtotal')->nullable(); 
            $table->string('shipping_charge')->nullable();  
            $table->string('vat')->nullable(); //integer
            $table->string('total')->nullable(); 
            $table->string('status')->nullable()->default(0);
            $table->string('month')->nullable();
            $table->string('date')->nullable();
            $table->string('year')->nullable();
            $table->string('status_code')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
