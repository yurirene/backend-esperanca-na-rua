<?php

namespace Database\Seeders;

use App\Models\Perfil;
use App\Services\PerfilService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PerfilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfis = [
            [
                'nome' => 'Administrador',
                'name' => 'administrador'
            ],
            [
                'nome' => 'Operador Chamados',
                'name' => 'operador_chamados'
            ],
            [
                'nome' => 'Parceiro - Administrador',
                'name' => 'parceiro_administrador'
            ],
            [
                'nome' => 'Parceiro - Operador',
                'name' => 'parceiro_operador'
            ],
            [
                'nome' => 'Operador Interno',
                'name' => 'operador_interno'
            ],
            [
                'nome' => 'Operador Externo',
                'name' => 'operador_externo'
            ],
            [
                'nome' => 'Acesso Externo',
                'name' => 'acesso_externo'
            ],
        ];
        DB::beginTransaction();
        try {
            foreach ($perfis as $perfil) {
                Perfil::updateOrCreate(
                    [
                        'name' => $perfil['name']
                    ],
                    $perfil
                );
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
}
