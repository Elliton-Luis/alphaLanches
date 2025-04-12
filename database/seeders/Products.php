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
            'price' => 7,
            'type' => 'savory',
            'amount' => '3',
        ]);
        Produto::create([
            'name' => 'Pastel',
            'describe' => 'Pastel de frango',
            'price' => 2,
            'type' => 'savory',
            'amount' => '1',
        ]);
        Produto::create([
            'name' => 'Água',
            'describe' => '',
            'price' => 3,
            'type' => 'drink',
            'amount' => '7',
        ]);
        Produto::create([
            'name' => 'Bolo',
            'describe' => 'bolo de chocolate',
            'price' => 10,
            'type' => 'snacks',
            'amount' => '2',
        ]);
        Produto::create([
            'name' => 'Coxinha',
            'describe' => 'Coxinha de frango com catupiry',
            'price' => 7.50,
            'type' => 'snacks',
            'amount' => 10,
        ]);
        
        Produto::create([
            'name' => 'Suco de Laranja',
            'describe' => 'Suco natural gelado',
            'price' => 5.00,
            'type' => 'drink',
            'amount' => 15,
        ]);
        
        Produto::create([
            'name' => 'Pastel',
            'describe' => 'Pastel de carne com queijo',
            'price' => 6.00,
            'type' => 'snacks',
            'amount' => 12,
        ]);
        
        Produto::create([
            'name' => 'Refrigerante Lata',
            'describe' => 'Coca-Cola 350ml',
            'price' => 4.50,
            'type' => 'drink',
            'amount' => 20,
        ]);
        
        Produto::create([
            'name' => 'Pão de Queijo',
            'describe' => 'Pão de queijo mineiro',
            'price' => 3.00,
            'type' => 'snacks',
            'amount' => 25,
        ]);
        
        Produto::create([
            'name' => 'Café Preto',
            'describe' => 'Café coado na hora',
            'price' => 2.50,
            'type' => 'drink',
            'amount' => 30,
        ]);
        
        Produto::create([
            'name' => 'Biscoito Recheado',
            'describe' => 'Biscoito sabor chocolate',
            'price' => 2.00,
            'type' => 'snacks',
            'amount' => 40,
        ]);
        
        Produto::create([
            'name' => 'Água Mineral',
            'describe' => 'Garrafa de 500ml',
            'price' => 2.00,
            'type' => 'drink',
            'amount' => 35,
        ]);
    }
}
