<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            PerfilSeeder::class,
            RotasSeeder::class,
            TipoParceiroSeeder::class,
            TipoDestinoSeeder::class,
            ParametrosSeeder::class,
            StatusSolicitacaoSeeder::class,
            UserSeeder::class
        ]);
    }
}
