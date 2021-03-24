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
            $table->id();
            // $table->uuid('id')->primary();
            $table->foreignId('customer_id')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->string('phoneNumber');
            $table->string('city');
            $table->string('street_address');
            $table->string('payment_method');
            $table->string('payment_id');
            $table->boolean('completed')->default(false);
            $table->decimal('subtotal');
            $table->decimal('discount')->nullable();
            $table->decimal('subafterdiscount')->nullable();
            $table->decimal('tax');
            $table->decimal('grand');
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
