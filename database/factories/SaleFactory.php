<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Sale>
 */
class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition(): array
    {
        return [
            'customer_id' => User::inRandomOrder()->first()->id,
            'saleDate' => $this->faker->dateTimeBetween('-6 months', 'now')->format('Y-m-d'),
            'value' => $this->faker->randomFloat(2, 5, 100),
        ];
    }
}
