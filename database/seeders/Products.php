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
            'name' => 'Suco Detox',
            'describe' => 'Suco verde com limão e couve',
            'price' => 6.00,
            'type' => 'natural',
            'amount' => 10,
        ]);
        
        Produto::create([
            'name' => 'Empada de Frango',
            'describe' => 'Empada caseira com recheio cremoso',
            'price' => 4.00,
            'type' => 'salgado',
            'amount' => 15,
        ]);
        
        Produto::create([
            'name' => 'Marmita Fitness',
            'describe' => 'Frango grelhado com batata doce',
            'price' => 15.00,
            'type' => 'almoço',
            'amount' => 8,
        ]);
        
        Produto::create([
            'name' => 'Tapioca com Queijo',
            'describe' => 'Tapioca recheada com queijo coalho',
            'price' => 5.00,
            'type' => 'lanche',
            'amount' => 12,
        ]);
        
        Produto::create([
            'name' => 'Refrigerante Guaraná',
            'describe' => 'Refrigerante 350ml',
            'price' => 4.50,
            'type' => 'bebida',
            'amount' => 18,
        ]);
        
        Produto::create([
            'name' => 'Barra de Cereal',
            'describe' => 'Sabor banana com aveia',
            'price' => 2.50,
            'type' => 'natural',
            'amount' => 30,
        ]);
        
        Produto::create([
            'name' => 'Esfirra de Carne',
            'describe' => 'Esfirra aberta com carne moída',
            'price' => 3.50,
            'type' => 'salgado',
            'amount' => 25,
        ]);
        
        Produto::create([
            'name' => 'Marmita Tradicional',
            'describe' => 'Arroz, feijão, carne e salada',
            'price' => 13.00,
            'type' => 'almoço',
            'amount' => 10,
        ]);
        
        Produto::create([
            'name' => 'Sanduíche Natural',
            'describe' => 'Pão integral com peito de peru',
            'price' => 6.50,
            'type' => 'natural',
            'amount' => 20,
        ]);
        
        Produto::create([
            'name' => 'Café com Leite',
            'describe' => 'Café com leite quente',
            'price' => 3.00,
            'type' => 'bebida',
            'amount' => 22,
        ]);
        
        Produto::create([
            'name' => 'Croissant de Presunto',
            'describe' => 'Croissant recheado com presunto e queijo',
            'price' => 4.50,
            'type' => 'lanche',
            'amount' => 14,
        ]);
        
        Produto::create([
            'name' => 'Água de Coco',
            'describe' => 'Natural e gelada',
            'price' => 5.00,
            'type' => 'bebida',
            'amount' => 17,
        ]);
        
        Produto::create([
            'name' => 'Quibe Assado',
            'describe' => 'Quibe recheado com queijo',
            'price' => 3.00,
            'type' => 'salgado',
            'amount' => 19,
        ]);
        
        Produto::create([
            'name' => 'Lasanha',
            'describe' => 'Lasanha de carne com molho branco',
            'price' => 18.00,
            'type' => 'almoço',
            'amount' => 6,
        ]);
        
        Produto::create([
            'name' => 'Bolo Integral',
            'describe' => 'Bolo de banana com aveia',
            'price' => 4.00,
            'type' => 'natural',
            'amount' => 13,
        ]);
        
        Produto::create([
            'name' => 'Smoothie de Morango',
            'describe' => 'Vitamina gelada com frutas naturais',
            'price' => 7.00,
            'type' => 'bebida',
            'amount' => 11,
        ]);
        
        Produto::create([
            'name' => 'Torta de Frango',
            'describe' => 'Torta cremosa com massa fina',
            'price' => 6.00,
            'type' => 'salgado',
            'amount' => 9,
        ]);
        
        Produto::create([
            'name' => 'Marmita Vegetariana',
            'describe' => 'Arroz integral, legumes e tofu',
            'price' => 14.00,
            'type' => 'almoço',
            'amount' => 7,
        ]);
        
        Produto::create([
            'name' => 'Iogurte Natural',
            'describe' => 'Sem açúcar, 170g',
            'price' => 3.50,
            'type' => 'natural',
            'amount' => 16,
        ]);
        
        Produto::create([
            'name' => 'Pão com Ovo',
            'describe' => 'Clássico lanche da manhã',
            'price' => 3.00,
            'type' => 'lanche',
            'amount' => 28,
        ]);
        
        Produto::create([
            'name' => 'Chá Gelado',
            'describe' => 'Chá de limão com hortelã',
            'price' => 4.00,
            'type' => 'bebida',
            'amount' => 12,
        ]);
        
        Produto::create([
            'name' => 'Enroladinho de Salsicha',
            'describe' => 'Massa crocante, recheio saboroso',
            'price' => 3.50,
            'type' => 'salgado',
            'amount' => 21,
        ]);
        
        Produto::create([
            'name' => 'Yakissoba',
            'describe' => 'Macarrão com carne e legumes',
            'price' => 17.00,
            'type' => 'almoço',
            'amount' => 5,
        ]);
        
        Produto::create([
            'name' => 'Frutas Picadas',
            'describe' => 'Copo com frutas variadas',
            'price' => 5.50,
            'type' => 'natural',
            'amount' => 20,
        ]);
        
        Produto::create([
            'name' => 'Mini Pizza',
            'describe' => 'Sabor calabresa com queijo',
            'price' => 5.00,
            'type' => 'lanche',
            'amount' => 18,
        ]);        
    }
}
