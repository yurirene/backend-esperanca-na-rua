<?php

namespace Database\Seeders;

use App\Services\RotaService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;

class RotasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

       try {
            $sufixos = [
                'index' => 'Listar',
                'show' => 'Detalhar',
                'create' => 'Formulário de Cadastro',
                'store' => 'Ação - Cadastrar',
                'edit' => 'Formulário de Edição',
                'update' => 'Ação - Atualizar',
                'delete' => 'Ação - Deletar',
                'datatable' => 'DataTable',
                'datatables' => 'DataTable',
                'status' => 'Ativar | Inativar',
                'disponivel' => 'Disponibilidade'
            ];

            $routes = collect(Route::getRoutes())->filter(function ($route) {
                if (!isset($route->action['middleware'])) {
                    return false;
                }
                return in_array('web', $route->action['middleware']) && key_exists('modulo', $route->action);
            })
            ->pluck('action')
            ->toArray();
            foreach ($routes as $route) {
                $action = explode('.', $route['as']);
                $nome = key_exists(end($action), $sufixos) ? $sufixos[end($action)] : end($action);
                $data = [
                    'nome' => $nome,
                    'uri' => $route['as'],
                    'modulo' => $route['modulo'],
                ];
                RotaService::store($data);
            }
       } catch (\Throwable $th) {
            dd($th->getMessage(), $th->getLine(), $th->getFile());
       }
    }
}
