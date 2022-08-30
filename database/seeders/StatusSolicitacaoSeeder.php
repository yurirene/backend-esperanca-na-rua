<?php

namespace Database\Seeders;

use App\Models\StatusSolicitacao;
use Illuminate\Database\Seeder;

class StatusSolicitacaoSeeder extends Seeder
{
    /**
     * Run the database seeds.    const STATUS = [
        self::ABERTO => 'Aberto',
        self::EM_ATENDIMENTO => 'Em Atendimento',
        self::ENCONTRADO => 'Encontrado',
        self::ENCAMINHADO => 'Encaminhado',
        self::CANCELADO => 'Cancelado',
        self::NAO_ENCONTRADO => 'Não Encontrado',
    ];

    const LABEL = [
        self::ABERTO => 'danger',
        self::EM_ATENDIMENTO => 'warning',
        self::ENCONTRADO => 'info',
        self::ENCAMINHADO => 'success',
        self::CANCELADO => 'dark',
        self::NAO_ENCONTRADO => 'dark',
    ];


     *
     * @return void
     */
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
        ];

        foreach ($status as $status) {
            StatusSolicitacao::updateOrCreate(['id' => $status['id']],$status);
        }
    }
}
