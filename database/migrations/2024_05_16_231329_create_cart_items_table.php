<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(
            'cart_items',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('cart_id');
                $table->unsignedBigInteger('product_id');
                $table->string('name');
                $table->string('image');
                $table->decimal('price', 10, 2);
                $table->integer('quantity');
                $table->string('color');
                $table->integer('size');
                $table->boolean('selected')->default(true);
                $table->timestamps();

                $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
                $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            }
        );
    }

    public function down()
    {
        Schema::dropIfExists('cart_items');
    }
};
