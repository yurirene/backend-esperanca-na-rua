<?php

namespace Database\Seeders;

use App\Models\StatusSolicitacao;
use Illuminate\Database\Seeder;

class StatusSolicitacaoSeeder extends Seeder
{

    public function run()
    {
        $status = [
            [
                'id' => 1,
                'descricao' => 'Aberto',
                'nome' => 'aberto',
                'color' => 'danger'
            ],
            [
                'id' => 2,
                'descricao' => 'Em Atendimento',
                'nome' => 'em-atendimento',
                'color' => 'warning'
            ],

            [
                'id' => 3,
                'descricao' => 'Encontrado',
                'nome' => 'encontrado',
                'color' => 'info'
            ],

            [
                'id' => 4,
                'descricao' => 'Encaminhado',
                'nome' => 'encaminhado',
                'color' => 'success'
            ],

            [
                'id' => 5,
                'descricao' => 'Cancelado',
                'nome' => 'cancelado',
                'color' => 'black'
            ],

            [
                'id' => 6,
                'descricao' => 'Não Encontrado',
                'nome' => 'nao-encontrado',
                'color' => 'black'
            ],

            [
                'id' => 7,
                'descricao' => 'Encerrado - Atendido',
                'nome' => 'encerrado-atendido',
                'color' => 'success'
            ],

            [
                'id' => 8,
                'descricao' => 'Encerrado - Desistência',
                'nome' => 'encerrado-desistencia',
                'color' => 'danger'
            ],
        ];

        foreach ($status as $status) {
            StatusSolicitacao::updateOrCreate(['id' => $status['id']], $status);
        }
    }
}
