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
        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-04-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '1', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-04-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '2', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-05-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '3', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-05-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '4', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-05-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '5', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-05-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '6', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-05-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '7', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-05-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '8', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-05-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '9', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-05-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '10', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-05-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '11', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-05-13',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '12', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-05-13',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '13', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-01-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '14', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-01-13',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '15', 
            'product_id' => '3', 
            'productQuantity' => 2,
        ]);

         Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-01-13',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '16', 
            'product_id' => '3', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-01-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '17', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-01-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '18', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-02-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '19', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-02-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '20', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-02-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '21', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-02-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '22', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-02-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '23', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-03-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '24', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-03-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '25', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-03-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '26', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-03-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '27', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-03-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '28', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '5',
            'saleDate' => '2025-04-01',
            'value' => 4.00,
        ]);

        SaleProduct::create([
            'sale_id' => '29', 
            'product_id' => '1', 
            'productQuantity' => 2,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-04-02',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '30', 
            'product_id' => '2', 
            'productQuantity' => 1,
        ]);

        Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-04-13',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '31', 
            'product_id' => '3', 
            'productQuantity' => 2,
        ]);

         Sale::create([
            'customer_id' => '6',
            'saleDate' => '2025-04-13',
            'value' => 6.00,
        ]);

        SaleProduct::create([
            'sale_id' => '32', 
            'product_id' => '3', 
            'productQuantity' => 2,
        ]);
    }
}
