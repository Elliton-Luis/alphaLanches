<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sale;
use App\Models\SaleProduct;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        // Gera 20 vendas
        Sale::factory()
            ->count(20)
            ->create()
            ->each(function ($sale) {
                // Para cada venda, adiciona entre 1 e 4 produtos
                SaleProduct::factory()->count(rand(1, 4))->create([
                    'sale_id' => $sale->id
                ]);
            });
    }
}
