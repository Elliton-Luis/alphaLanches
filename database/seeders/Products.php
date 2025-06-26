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
            'name' => 'Hambúrguer Clássico',
            'describe' => 'Pão, carne, queijo, alface e tomate.',
            'price' => '15',
            'type' => 'lunch',
            'amount' => '20',
        ]);
        Produto::create([
            'name' => 'X-Bacon',
            'describe' => 'Pão, carne, queijo, bacon, alface e tomate.',
            'price' => '18',
            'type' => 'lunch',
            'amount' => '18',
        ]);
        Produto::create([
            'name' => 'Torta de Frango',
            'describe' => 'Fatia de torta caseira de frango com catupiry.',
            'price' => '12',
            'type' => 'lunch',
            'amount' => '15',
        ]);
        Produto::create([
            'name' => 'Coxinha de Frango',
            'describe' => 'Coxinha tradicional de frango com massa de batata.',
            'price' => '7',
            'type' => 'savory',
            'amount' => '40',
        ]);
        Produto::create([
            'name' => 'Esfiha de Carne',
            'describe' => 'Esfiha aberta de carne.',
            'price' => '6',
            'type' => 'savory',
            'amount' => '30',
        ]);
        Produto::create([
            'name' => 'Enroladinho de Salsicha',
            'describe' => 'Salsicha envolvida em massa assada.',
            'price' => '6',
            'type' => 'savory',
            'amount' => '25',
        ]);
        Produto::create([
            'name' => 'Joelho (Italiano)',
            'describe' => 'Salgado assado de presunto e queijo.',
            'price' => '8',
            'type' => 'savory',
            'amount' => '28',
        ]);
        Produto::create([
            'name' => 'Misto Quente',
            'describe' => 'Pão de forma com presunto e queijo na chapa.',
            'price' => '9',
            'type' => 'snacks',
            'amount' => '22',
        ]);
        Produto::create([
            'name' => 'Mini Pizza',
            'describe' => 'Mini pizza de muçarela ou calabresa.',
            'price' => '10',
            'type' => 'savory',
            'amount' => '20',
        ]);
        Produto::create([
            'name' => 'Bolo de Chocolate',
            'describe' => 'Fatia de bolo de chocolate com cobertura.',
            'price' => '10',
            'type' => 'snacks',
            'amount' => '12',
        ]);
        Produto::create([
            'name' => 'Pipoca Doce',
            'describe' => 'Pipoca caramelizada crocante.',
            'price' => '4',
            'type' => 'snacks',
            'amount' => '30',
        ]);
        Produto::create([
            'name' => 'Pipoca Salgada',
            'describe' => 'Pipoca salgada com manteiga.',
            'price' => '4',
            'type' => 'snacks',
            'amount' => '30',
        ]);
        Produto::create([
            'name' => 'Pão de Queijo',
            'describe' => 'Porção com 5 unidades de pão de queijo.',
            'price' => '6',
            'type' => 'snacks',
            'amount' => '40',
        ]);
        Produto::create([
            'name' => 'Brigadeiro',
            'describe' => 'Doce tradicional de chocolate (unidade).',
            'price' => '3',
            'type' => 'snacks',
            'amount' => '50',
        ]);
        Produto::create([
            'name' => 'Beijinho',
            'describe' => 'Doce de coco (unidade).',
            'price' => '3',
            'type' => 'snacks',
            'amount' => '50',
        ]);
        Produto::create([
            'name' => 'Salada de Frutas',
            'describe' => 'Copo com mix de frutas frescas da estação.',
            'price' => '9',
            'type' => 'natural',
            'amount' => '15',
        ]);
        Produto::create([
            'name' => 'Açaí na Tigela',
            'describe' => 'Açaí 300ml com banana e granola.',
            'price' => '16',
            'type' => 'natural',
            'amount' => '20',
        ]);
        Produto::create([
            'name' => 'Pudim de Leite',
            'describe' => 'Fatia de pudim de leite condensado.',
            'price' => '8',
            'type' => 'snacks',
            'amount' => '10',
        ]);
        Produto::create([
            'name' => 'Brownie',
            'describe' => 'Brownie de chocolate com nozes.',
            'price' => '9',
            'type' => 'snacks',
            'amount' => '18',
        ]);
        Produto::create([
            'name' => 'Mousse de Maracujá',
            'describe' => 'Copo de mousse de maracujá cremoso.',
            'price' => '7',
            'type' => 'snacks',
            'amount' => '20',
        ]);
        Produto::create([
            'name' => 'Croissant',
            'describe' => 'Croissant simples ou com queijo e presunto.',
            'price' => '9',
            'type' => 'snacks',
            'amount' => '15',
        ]);
        Produto::create([
            'name' => 'Biscoito Polvilho',
            'describe' => 'Pacote de biscoito de polvilho doce ou salgado.',
            'price' => '5',
            'type' => 'snacks',
            'amount' => '40',
        ]);
        Produto::create([
            'name' => 'Água Mineral sem Gás',
            'describe' => 'Garrafa de 500ml.',
            'price' => '3',
            'type' => 'drink',
            'amount' => '50',
        ]);
        Produto::create([
            'name' => 'Água Mineral com Gás',
            'describe' => 'Garrafa de 500ml.',
            'price' => '4',
            'type' => 'drink',
            'amount' => '40',
        ]);
        Produto::create([
            'name' => 'Refrigerante Lata',
            'describe' => 'Lata de refrigerante 350ml (diversos sabores).',
            'price' => '6',
            'type' => 'drink',
            'amount' => '60',
        ]);
        Produto::create([
            'name' => 'Refrigerante 600ml',
            'describe' => 'Garrafa de refrigerante 600ml (diversos sabores).',
            'price' => '9',
            'type' => 'drink',
            'amount' => '30',
        ]);
        Produto::create([
            'name' => 'Suco Natural de Laranja',
            'describe' => 'Copo de 300ml de suco de laranja feito na hora.',
            'price' => '8',
            'type' => 'natural',
            'amount' => '25',
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
            'name' => 'Café Expresso',
            'describe' => 'Café quente tirado na máquina.',
            'price' => '5',
            'type' => 'drink',
            'amount' => '50',
        ]);
        Produto::create([
            'name' => 'Café com Leite (Pingado)',
            'describe' => 'Café com leite tradicional.',
            'price' => '6',
            'type' => 'drink',
            'amount' => '40',
        ]);
        Produto::create([
            'name' => 'Chá Gelado',
            'describe' => 'Copo de chá gelado de limão ou pêssego.',
            'price' => '6',
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
        Produto::create([
            'name' => 'Vitamina de Frutas',
            'describe' => 'Copo 300ml de banana, mamão e maçã com leite.',
            'price' => '10',
            'type' => 'natural',
            'amount' => '15',
        ]);
        Produto::create([
            'name' => 'Chocolate Quente',
            'describe' => 'Chocolate quente cremoso (servido no inverno).',
            'price' => '9',
            'type' => 'drink',
            'amount' => '15',
        ]);
        Produto::create([
            'name' => 'Energético',
            'describe' => 'Lata de energético 250ml.',
            'price' => '12',
            'type' => 'drink',
            'amount' => '18',
        ]);
    }
}
