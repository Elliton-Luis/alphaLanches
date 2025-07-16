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
            'describe' => 'Pão, salsicha, purê, batata palha e vinagrete.',
            'price' => '7',
            'type' => 'lunch',
            'amount' => '25',
        ]);
        Produto::create([
            'name' => 'Pastel de Carne',
            'describe' => 'Pastel tradicional de carne moída.',
            'price' => '8',
            'type' => 'savory',
            'amount' => '30',
        ]);
        Produto::create([
            'name' => 'Pastel de Queijo',
            'describe' => 'Pastel recheado com queijo muçarela.',
            'price' => '8',
            'type' => 'savory',
            'amount' => '35',
        ]);
        Produto::create([
            'name' => 'Suco Natural de Abacaxi',
            'describe' => 'Copo de 300ml de suco de abacaxi com hortelã.',
            'price' => '8',
            'type' => 'natural',
            'amount' => '25',
        ]);
        Produto::create([
            'name' => 'Suco de Polpa',
            'describe' => 'Copo 300ml (morango, manga, goiaba).',
            'price' => '7',
            'type' => 'drink',
            'amount' => '30',
        ]);
        Produto::create([
            'name' => 'Caldo de Cana',
            'describe' => 'Copo de 300ml de caldo de cana com limão.',
            'price' => '7',
            'type' => 'natural',
            'amount' => '20',
        ]);
    }
}
