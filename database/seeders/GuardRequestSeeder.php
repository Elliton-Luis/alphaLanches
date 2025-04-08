<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GuardRequest;

class GuardRequestSeeder extends Seeder
{
    public function run(): void
    {
        GuardRequest::create([
            'name'=>'pai de joao',
            'email'=>'guard1@mail.com',
            'telefone'=>'75999488795',
            'cpf'=>'86629385586'
        ]);
        GuardRequest::create([
            'name'=>'pai de pedro',
            'email'=>'guard2@mail.com',
            'telefone'=>'75999488745',
            'cpf'=>'86619385586'
        ]);
    }
}
