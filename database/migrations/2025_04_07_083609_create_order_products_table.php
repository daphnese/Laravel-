<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_products', function (Blueprint $table) {
            $table->id('order_product_id')->primary();
            $table->unsignedBigInteger('order_id');
            $table->smallInteger('product_id');
            $table->integer('quantity');
            $table->decimal('sub_total', 10, 2);
            $table->timestamps();
            $table->foreign('order_id')->references('order_id')->on('orders')
                ->ondelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('product_id')->on('products')
                ->ondelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_products');
    }
};
