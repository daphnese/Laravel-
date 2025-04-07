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
        Schema::create('products', function (Blueprint $table) {
            $table->smallInteger('product_id', true)->primary();
            $table->text('image');
            $table->string('name', 100);
            $table->tinyInteger('category_id');
            $table->decimal('price', 10, 2);
            $table->text('description');
            $table->timestamps();
            $table->foreign('category_id')->references('category_id')
                ->on('categories')->ondelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
