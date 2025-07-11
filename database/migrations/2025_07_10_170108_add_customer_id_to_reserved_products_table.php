<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('reserved_products', function (Blueprint $table) {
            $table->unsignedBigInteger('customer_id')->after('product_id');

            // Se a tabela customers existir e você quiser criar uma foreign key:
            $table->foreign('customer_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('reserved_products', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropColumn('customer_id');
        });
    }
};
