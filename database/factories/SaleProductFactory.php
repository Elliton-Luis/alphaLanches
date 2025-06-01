<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\Produto;
use App\Models\SaleProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<SaleProduct>
 */
class SaleProductFactory extends Factory
{
    protected $model = SaleProduct::class;

    public function definition(): array
    {
        return [
            'sale_id' => Sale::factory(),
            'product_id' => Produto::inRandomOrder()->first()->id, // Produto existente
            'productQuantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
