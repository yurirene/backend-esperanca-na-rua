<?php

namespace App\Http\Controllers;

use App\DataTables\ParceirosDataTable;
use App\DataTables\UsersDataTable;
use App\Models\Parceiro;
use App\Services\ParceiroService;
use Illuminate\Http\Request;

class ConfiguracaoController extends Controller
{
    public function parceiros()
    {
        $dataTable = new ParceirosDataTable(true);
        try {
            return $dataTable->render('parceiros.index');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar');
        }
    }

    public function usuarios()
    {
        session()->put('is_configuracao', true);
        $dataTable = new UsersDataTable(true);
        try {
            return $dataTable->render('usuarios.index');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar');
        }
    }

}
