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
            'name'=>'Loja',
            'email'=>'loja@email.com',
            'password'=>bcrypt('password'),
            'profile'=>'loja',
            'loja_id'=>1
        ]);


    }
}
