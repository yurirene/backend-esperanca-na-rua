<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Yuri',
            'email' => 'yurirene@gmail.com',
            'password' => Hash::make('123'),
            'perfil_id' => 1,
            'is_super' => 1,
            'ativo' => 1
        ]);
        User::create([
            'name' => 'teste',
            'email' => 'teste@teste.com',
            'password' => Hash::make('123'),
            'perfil_id' => 6,
            'ativo' => 1
        ]);
    }
}
