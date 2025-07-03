<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{

    public function run(): void
    {

        User::create([
            'name' => 'admin1',
            'email' => 'admin1@mail.com',
            'password' => bcrypt('admin@123'),
            'type' => 'admin',
            'telefone' => '11912345678'
        ]);

        User::create([
            'name' => 'admin2',
            'email' => 'admin2@mail.com',
            'password' => bcrypt('admin@123'),
            'type' => 'admin',
            'telefone' => '21998765432'
        ]);

        User::create([
            'name' => 'func1',
            'email' => 'func1@mail.com',
            'password' => bcrypt('func@123'),
            'type' => 'func',
            'telefone' => '31987654321'
        ]);

        User::create([
            'name' => 'func2',
            'email' => 'func2@mail.com',
            'password' => bcrypt('func@123'),
            'type' => 'func',
            'telefone' => '41912348765'
        ]);

        User::create([
            'name' => 'pai1',
            'email' => 'pai1@mail.com',
            'password' => bcrypt('pai@123'),
            'type' => 'guard',
            'telefone' => '51998876655'
        ]);

        User::create([
            'name' => 'pai2',
            'email' => 'pai2@mail.com',
            'password' => bcrypt('pai@123'),
            'type' => 'guard',
            'telefone' => '61977665544'
        ]);

        User::create([
            'name' => 'student1',
            'email' => 'student1@mail.com',
            'password' => bcrypt('student@123'),
            'type' => 'student',
            'telefone' => '71988889999'
        ]);

        User::create([
            'name' => 'student2',
            'email' => 'student2@mail.com',
            'password' => bcrypt('student@123'),
            'type' => 'student',
            'telefone' => '81977778888'
        ]);


    }
}
