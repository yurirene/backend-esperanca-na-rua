<?php

namespace Database\Seeders;

use App\Models\Parametro;
use App\Models\ValorParametro;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParametrosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
            Parametro::GRUPO_FORMULARIO => [
                [
                    'nome' => 'faixa_etaria',
                    'titulo' => 'Faixa Etária',
                    'valor' => [
                        '10-15',
                        '16-20',
                        '21-25',
                        '26-30',
                        '31-35',
                        '36-40',
                        '41-45',
                        '46-50'
                    ],
                    'grupo_parametros' => Parametro::GRUPO_FORMULARIO
                ],
                [
                    'nome' => 'genero',
                    'titulo' => 'Gênero',
                    'valor' => [
                        'Masculino',
                        'Feminino'
                    ],
                    'grupo_parametros' => Parametro::GRUPO_FORMULARIO
                ],
                [
                    'nome' => 'genero',
                    'titulo' => 'Gênero',
                    'valor' => [
                        'Masculino',
                        'Feminino'
                    ],
                    'grupo_parametros' => Parametro::GRUPO_FORMULARIO
                ],
                [
                    'nome' => 'tempo_rua',
                    'titulo' => 'Tempo de Rua',
                    'valor' => [
                        '< 1 ano',
                        '1-2 anos',
                        '3-5 anos',
                        '6-8 nos',
                        '8-10 anos',
                        '>10 anos',
                    ],
                    'grupo_parametros' => Parametro::GRUPO_FORMULARIO
                ],
                [
                    'nome' => 'sobriedade',
                    'titulo' => 'Condição Física (Sobriedade)',
                    'valor' => [
                        'Sim',
                        'Não'
                    ],
                    'grupo_parametros' => Parametro::GRUPO_FORMULARIO
                ],
                [
                    'nome' => 'limpeza',
                    'titulo' => 'Condição Física (Limpeza)',
                    'valor' => [
                        'Sim',
                        'Não'
                    ],
                    'grupo_parametros' => Parametro::GRUPO_FORMULARIO
                ],
                [
                    'nome' => 'passagem_policia',
                    'titulo' => 'Passagem pela Polícia',
                    'valor' => [
                        'Não',
                        'Cumprida',
                        'Pendente'
                    ],
                    'grupo_parametros' => Parametro::GRUPO_FORMULARIO
                ],
            ]
        ];

        DB::beginTransaction();
        try {
            foreach ($dados as $grupo) {
                foreach ($grupo as $dado) {
                    $parametro = Parametro::updateOrCreate(
                        [
                            'nome' => $dado['nome']
                        ],
                        [
                            'nome' => $dado['nome'],
                            'titulo' => $dado['titulo'],
                            'grupo_parametros' => $dado['grupo_parametros']
                        ]
                    );
                    $parametro->valores()->delete();
                    foreach ($dado['valor'] as $valor) {
                        ValorParametro::create([
                            'valor' => $valor,
                            'parametro_id' => $parametro->id
                        ]);
                    }
                }
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
