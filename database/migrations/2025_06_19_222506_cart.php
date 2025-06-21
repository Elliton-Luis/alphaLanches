<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        $table->id();
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // caixa dono do carrinho
        $table->timestamps();
    }
    public function down(): void
    {
        
    }
};
