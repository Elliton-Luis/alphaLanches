<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produto;

class Products extends Seeder
{
    public function run(): void
    {
        Produto::create([
            'name' => 'Cachorro Quente',
            'describe' => 'Cachorro quente de salsicha',
            'price' => '7',
            'type' => 'savory',
            'amount' => '3',
        ]);
        Produto::create([
            'name' => 'Pastel',
            'describe' => 'Pastel de frango',
            'price' => '2',
            'type' => 'savory',
            'amount' => '1',
        ]);
        Produto::create([
            'name' => 'Água',
            'describe' => '',
            'price' => '3',
            'type' => 'drink',
            'amount' => '7',
        ]);
        Produto::create([
            'name' => 'Bolo',
            'describe' => 'bolo de chocolate',
            'price' => '10',
            'type' => 'snacks',
            'amount' => '2',
        ]);
    }
}
