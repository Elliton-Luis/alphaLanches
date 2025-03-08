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
            'name'=>'admin1',
            'email'=>'admin1@mail.com',
            'password'=>bcrypt('admin@123'),
            'type'=>'admin'
        ]);

        User::create([
            'name'=>'admin2',
            'email'=>'admin2@mail.com',
            'password'=>bcrypt('admin@123'),
            'type'=>'admin'
        ]);

        User::create([
            'name'=>'admin3',
            'email'=>'admi3n@mail.com',
            'password'=>bcrypt('admin@123'),
            'type'=>'admin'
        ]);

        User::create([
            'name'=>'func1',
            'email'=>'func1@mail.com',
            'password'=>bcrypt('func@123'),
            'type'=>'func'
        ]);
    }
}
