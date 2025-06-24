<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('cart_id')->constrained('carts','id');
        $table->foreignId('product_id')->constrained('products','id')->onDelete('cascade');
        $table->integer('quantity')->default(1);
        $table->timestamps();
    });
    }

    public function down(): void
    {
        //
    }
};
