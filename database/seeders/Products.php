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
        Produto::create([
            'name' => 'Refrigerante',
            'describe' => 'Lata de refrigerante 350ml',
            'price' => '5',
            'type' => 'drink',
            'amount' => '10',
        ]);

        Produto::create([
            'name' => 'Suco Natural',
            'describe' => 'Suco de laranja natural',
            'price' => '6',
            'type' => 'drink',
            'amount' => '5',
        ]);

        Produto::create([
            'name' => 'Hambúrguer',
            'describe' => 'Hambúrguer artesanal de carne',
            'price' => '15',
            'type' => 'savory',
            'amount' => '4',
        ]);

        Produto::create([
            'name' => 'Pipoca Doce',
            'describe' => 'Pipoca caramelizada',
            'price' => '4',
            'type' => 'snacks',
            'amount' => '8',
        ]);

        Produto::create([
            'name' => 'Café',
            'describe' => 'Café quente coado',
            'price' => '3',
            'type' => 'drink',
            'amount' => '12',
        ]);

        Produto::create([
            'name' => 'Torta de Frango',
            'describe' => 'Torta caseira de frango com catupiry',
            'price' => '12',
            'type' => 'savory',
            'amount' => '3',
        ]);

        Produto::create([
            'name' => 'Coxinha',
            'describe' => 'Coxinha de frango tradicional',
            'price' => '6',
            'type' => 'savory',
            'amount' => '7',
        ]);

        Produto::create([
            'name' => 'Pão de Queijo',
            'describe' => 'Pão de queijo mineiro',
            'price' => '3',
            'type' => 'snacks',
            'amount' => '9',
        ]);

        Produto::create([
            'name' => 'Brigadeiro',
            'describe' => 'Doce tradicional de chocolate',
            'price' => '2',
            'type' => 'snacks',
            'amount' => '15',
        ]);

        Produto::create([
            'name' => 'Salada de Frutas',
            'describe' => 'Mix de frutas frescas',
            'price' => '7',
            'type' => 'snacks',
            'amount' => '5',
        ]);

        Produto::create([
            'name' => 'Esfiha',
            'describe' => 'Esfiha de carne',
            'price' => '5',
            'type' => 'savory',
            'amount' => '6',
        ]);

        Produto::create([
            'name' => 'Chá Gelado',
            'describe' => 'Chá gelado de limão',
            'price' => '4',
            'type' => 'drink',
            'amount' => '7',
        ]);

    }
}
