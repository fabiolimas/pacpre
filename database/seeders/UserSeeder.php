<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name'=>'Administrador',
            'email'=>'adm@email.com',
            'password'=>bcrypt('password'),
            'profile'=>'admin'
        ]);

        User::create([
            'name'=>'Gerente',
            'email'=>'gerente@email.com',
            'password'=>bcrypt('password'),
            'profile'=>'gerente'
        ]);

        User::create([
            'name'=>'Vendedor',
            'email'=>'vendedor@email.com',
            'password'=>bcrypt('password'),
            'profile'=>'vendedor'
        ]);

    }
}
