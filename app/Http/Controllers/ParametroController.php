<?php

namespace App\Http\Controllers;

use App\Services\ParametroService;
use Illuminate\Http\Request;

class ParametroController extends Controller
{
    public function index()
    {
        try {
            $parametrosFormularios = ParametroService::getParametrosFormulario()->toArray();
            return view('parametros.index', [
                'parametrosFormularios' => $parametrosFormularios
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar');
        }
    }

    public function store(Request $request)
    {
        try {
            ParametroService::store($request->all());
            return redirect()->route('configuracoes.parametros.index')
                ->with('sucesso', 'Parametro cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('configuracoes.parametros.index')
                ->with('erro', 'Erro ao Cadastrar');
        }
    }

    public function update(Request $request)
    {
        try {
            ParametroService::update($request->all());
            return redirect()->route('configuracoes.parametros.index')
                ->with('sucesso', 'Parametro atualizado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('configuracoes.parametros.index')
                ->with('erro', 'Erro ao Atualizar');
        }
    }

    public function delete(Request $request)
    {
        try {
            ParametroService::delete($request->all());
            return redirect()->route('configuracoes.parametros.index')
                ->with('sucesso', 'Parâmetro removido com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('configuracoes.parametros.index')
                ->with('erro', 'Erro ao Remover');
        }
    }
}
