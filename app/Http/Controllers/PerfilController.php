<?php

namespace App\Http\Controllers;

use App\Services\PerfilService;
use Illuminate\Http\Request;

class PerfilController extends Controller
{

    public function index()
    {
        try {
            $perfis = PerfilService::getPerfilRota();
            return view('perfis.index', [
                'perfis' => $perfis
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar');
        }
    }

    public function atualizarRotas(Request $request)
    {
        try {
            PerfilService::atualizarRota($request->all());
            return response()->json('Sucesso', 200);
        } catch (\Throwable $th) {
            return response()->json('Erro', 500);
        }
    }
}
