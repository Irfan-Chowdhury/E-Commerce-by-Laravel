<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('category')->nullable(); //tinyInteger
            $table->tinyInteger('coupon')->nullable();
            $table->tinyInteger('product')->nullable();
            $table->tinyInteger('blog')->nullable();
            $table->tinyInteger('order')->nullable();
            $table->tinyInteger('report')->nullable();
            $table->tinyInteger('role')->nullable();
            $table->tinyInteger('return')->nullable();
            $table->tinyInteger('contact')->nullable();
            $table->tinyInteger('comment')->nullable();
            $table->tinyInteger('setting')->nullable();
            $table->tinyInteger('stock')->nullable();
            $table->tinyInteger('other')->nullable();
            $table->tinyInteger('type')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
