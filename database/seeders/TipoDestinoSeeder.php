<?php

namespace Database\Seeders;

use App\Models\TipoDestino;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDestinoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $destinos = [
            [
                'id' => 1,
                'descricao' => 'Casa de Recuperação',
                'nome' => 'casa-recuperacao'
            ],
            [
                'id' => 2,
                'descricao' => 'Casa de Recuperação (só com cachorro)',
                'nome' => 'casa-recuperacao-cachorro'
            ],

            [
                'id' => 3,
                'descricao' => 'Cidade Natal ou Família Local',
                'nome' => 'cidade-natal-familia-local'
            ],

            [
                'id' => 4,
                'descricao' => 'Abrigo',
                'nome' => 'abrigo'
            ],

            [
                'id' => 5,
                'descricao' => 'Trabalho',
                'nome' => 'trabalho'
            ],

            [
                'id' => 6,
                'descricao' => 'Abrigo e Trabalho',
                'nome' => 'abrigo-e-trabalho'
            ],
        ];

        foreach ($destinos as $destino) {
            TipoDestino::updateOrCreate(['id' => $destino['id']],$destino);
        }
    }
}
