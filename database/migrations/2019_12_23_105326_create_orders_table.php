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
            // $table->bigIncrements('id');
            $table->uuid('id')->primary();
            $table->UnsignedBigInteger('user_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phoneNumber');
            $table->string('city');
            $table->string('street_address');
            $table->string('payment_method');
            $table->integer('subtotal');
            $table->integer('discount')->nullable();
            $table->integer('subafterdiscount')->nullable();
            $table->integer('tax');
            $table->integer('grand');
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
