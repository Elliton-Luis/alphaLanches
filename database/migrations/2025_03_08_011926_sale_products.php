<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sale_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sale_id')->constrained('sales','id')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products','id')->onDelete('cascade');
            $table->integer('productQuantity');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sale_products');
    }
};
