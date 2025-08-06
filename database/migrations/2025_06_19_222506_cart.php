<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['open', 'completed'])->default('open');
            $table->decimal('total')->default(0);
            $table->enum('paymentMethod', ['cash', 'pix', 'card'])->nullable();
            $table->date('scheduled_date')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {

    }
};
