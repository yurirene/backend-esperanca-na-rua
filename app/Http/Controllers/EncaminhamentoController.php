<?php

namespace App\Http\Controllers;

use App\Services\MoradorRuaService;
use Illuminate\Http\Request;

class EncaminhamentoController extends Controller
{
    public function encaminhar(Request $request)
    {
        try {
            MoradorRuaService::encaminhar($request->all());
            return redirect()->route('morador-rua.show', $request['morador_rua_id'])
                ->with('sucesso', 'Dados salvos com sucesso');
        } catch (\Throwable $th) {
            return redirect()->route('morador-rua.show', $request['morador_rua_id'])
                ->with('erro', 'Erro ao Carregar');
        }
    }
}
