<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->UnsignedBigInteger('category_id');
            $table->UnsignedBigInteger('subcategory_id');
            $table->string('imageUrl')->nullable();
            $table->string('name');
            $table->integer('price');
            $table->string('qty');
            $table->string('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->boolean('visible')->default(true);
            $table->boolean('featured')->default(false);
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
        Schema::dropIfExists('products');
    }
}
