<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
         Schema::table('sales', function (Blueprint $table) {
            $table->date('scheduled_date')->nullable()->after('saleDate');
        });
    }

    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('scheduled_date');
        });
    }
};
