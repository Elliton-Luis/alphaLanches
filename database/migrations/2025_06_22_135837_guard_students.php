<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guard_students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guard_id')->constrained('users','id');
            $table->foreignId('student_id')->constrained('users','id');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guard_students');
    }
};
