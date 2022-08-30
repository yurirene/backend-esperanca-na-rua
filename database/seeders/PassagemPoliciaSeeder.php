<?php

namespace Database\Seeders;

use App\Models\PassagemPolicia;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PassagemPoliciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $passagens = [
            [
                'id' => 1,
                'descricao' => 'Sem Passagem',
                'nome' => 'sem-passagem'
            ],
            [
                'id' => 2,
                'descricao' => 'Passagem Cumprida',
                'nome' => 'passagem-cumprida'
            ],

            [
                'id' => 3,
                'descricao' => 'Passagem Pendente',
                'nome' => 'passagem-pendente'
            ],
        ];

        foreach ($passagens as $passagem) {
            PassagemPolicia::updateOrCreate(['id' => $passagem['id']],$passagem);
        }
    }
}
