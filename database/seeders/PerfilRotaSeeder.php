<?php

namespace Database\Seeders;

use App\Models\Perfil;
use App\Models\Rotas;
use Illuminate\Database\Seeder;

class PerfilRotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $perfis = [
            'administrador' => [
                'dashboard.index',
                'morador-rua.index',
                'morador-rua.create',
                'morador-rua.store',
                'morador-rua.show',
                'morador-rua.edit',
                'morador-rua.update',
                'morador-rua.delete',
                'morador-rua.encaminhar',
                'parceiros.index',
                'parceiros.create',
                'parceiros.store',
                'parceiros.show',
                'parceiros.edit',
                'parceiros.update',
                'parceiros.status',
                'parceiros.disponivel',
                'parceiros.usuarios.datatables',
                'parceiros.get-usuarios',
                'parceiros.add-usuarios',
                'parceiros.remover-usuario',
                'usuarios.index',
                'usuarios.create',
                'usuarios.store',
                'usuarios.show',
                'usuarios.edit',
                'usuarios.update',
                'usuarios.status',
                'configuracoes.parceiros.index',
                'configuracoes.usuarios.index',
                'configuracoes.parametros.index',
                'configuracoes.parametros.update',
                'configuracoes.parametros.delete',
                'configuracoes.parametros.store',
                'morador-rua.alterar-foto',
                'morador-rua.identificacao',
                'morador-rua.outras-informacoes'
            ],
            'operador_chamados' => [
                'dashboard.index',
                'dashboard.operador',
                'parceiros.index',
                'parceiros.status',
                'morador-rua.index',
                'morador-rua.create',
                'morador-rua.store',
                'morador-rua.show',
                'morador-rua.edit',
                'morador-rua.update',
                'morador-rua.delete',
                'morador-rua.encaminhar',
            ],
            'parceiro_administrador' => [
                'dashboard.index',
                'dashboard.parceiro',
                'morador-rua.index',
                'morador-rua.show',
                'morador-rua.update',
                'morador-rua.alterar-foto',
                'morador-rua.identificacao',
                'morador-rua.outras-informacoes',
                'parceiros.disponivel',
                'parceiros.usuarios.datatables',
                'parceiros.get-usuarios',
                'parceiros.add-usuarios',
                'parceiros.remover-usuario',
                'usuarios.index',
                'usuarios.create',
                'usuarios.store',
                'usuarios.show',
                'usuarios.edit',
                'usuarios.update',
                'usuarios.status'
            ],
            'parceiro_operador' => [
                'dashboard.index',
                'dashboard.parceiro',
                'morador-rua.index',
                'morador-rua.show',
                'morador-rua.update',
                'morador-rua.encaminhar',
                'morador-rua.alterar-foto',
                'morador-rua.identificacao',
                'morador-rua.outras-informacoes',
                'parceiros.disponivel'
            ],
            'operador_interno' => [
                'dashboard.index',
                'dashboard.operador',
                'morador-rua.index',
                'morador-rua.show',
                'morador-rua.update',
                'morador-rua.encaminhar',
                'morador-rua.alterar-foto',
                'morador-rua.identificacao',
                'morador-rua.outras-informacoes',
                'parceiros.disponivel'
            ]
        ];

        try {
            foreach ($perfis as $perfil => $rotas) {
                $idsRotas = Rotas::whereIn('uri', $rotas)->get()->pluck('id');
                $perfilModel = Perfil::where('name', $perfil)->first();
                $perfilModel->rotas()->sync($idsRotas);
            }
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
}
