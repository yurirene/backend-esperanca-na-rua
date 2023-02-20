<?php

namespace App\Http\Controllers;

use App\DataTables\ParceirosDataTable;
use App\Models\Parceiro;
use App\Services\ParceiroService;
use Illuminate\Http\Request;

class ParceiroController extends Controller
{
    public function index(ParceirosDataTable $dataTable)
    {
        try {
            session()->put('is_configuracao', false);
            return $dataTable->render('parceiros.index');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar');
        }
    }

    public function create()
    {
        try {
            return view('parceiros.form', [
                'tipos_parceiros' => ParceiroService::getTiposParceirosForSelect(),
                'status' => ParceiroService::STATUS
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar Formulário');
        }
    }


    public function store(Request $request)
    {
        try {
            ParceiroService::store($request->all());
            $route = session()->get('is_configuracao')
                ? 'configuracoes.parceiros.index'
                : 'parceiros.index';
            return redirect()->route($route)
                ->with('sucesso', 'Parceiro cadastrado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Salvar Parceiro');
        }
    }

    public function show(Parceiro $parceiro)
    {
        try {
            return view('parceiros.show', [
                'parceiro' => $parceiro,
                'parceiros' => ParceiroService::getParceirosForSelect()
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('parceiros.index')
                ->with('erro', 'Erro ao Carregar dados do Parceiro');
        }
    }

    public function edit(Parceiro $parceiro)
    {
        try {
            return view('parceiros.form', [
                'parceiro' => $parceiro,
                'tipos_parceiros' => ParceiroService::getTiposParceirosForSelect(),
                'status' => ParceiroService::STATUS
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar Formulário');
        }
    }

    public function update(Parceiro $parceiro, Request $request)
    {
        try {
            ParceiroService::update($parceiro, $request->all());
            $route = session()->get('is_configuracao')
                ? 'configuracoes.parceiros.index'
                : 'parceiros.index';
            return redirect()->route($route)
                ->with('sucesso', 'Parceiro atualizado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Atualizar Parceiro');
        }
    }

    public function status(Parceiro $parceiro)
    {
        try {
            ParceiroService::status($parceiro);
            $route = session()->get('is_configuracao')
                ? 'configuracoes.parceiros.index'
                : 'parceiros.index';
            return redirect()->route($route)
                ->with('sucesso', 'Status alterado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao alterar status do Parceiro');
        }
    }

    public function disponivel(Parceiro $parceiro, Request $request)
    {

        try {
            ParceiroService::disponivel($parceiro, $request->all());
            $route = session()->get('is_configuracao')
                ? 'configuracoes.parceiros.index'
                : 'parceiros.index';
            return redirect()->route($route)
                ->with('sucesso', 'Status alterado com sucesso!');;
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao alterar status de Disponibilidade');
        }
    }

    public function usuarios(Parceiro $parceiro)
    {
        try {
            return ParceiroService::usuariosParceiro($parceiro);
        } catch (\Throwable $th) {
            return response()->json(['erro' => $th->getMessage()], 500);
        }
    }

    public function usuariosNaoRelacionados(int $parceiro)
    {
        try {
            return ParceiroService::getUsuariosNaoRelacionadosSelect($parceiro);
        } catch (\Throwable $th) {
            return response()->json(['erro' => $th->getMessage()], 500);
        }
    }

    public function relacionarUsuarios(Request $request)
    {
        try {
            ParceiroService::relacionarUsuarios($request->all());
            $route = session()->get('is_configuracao')
                ? 'configuracoes.parceiros.index'
                : 'parceiros.index';
            return redirect()->route($route)
                ->with('sucesso', 'Usuário relacionado com sucesso!');
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao relacionar Usuário');
        }
    }

    public function removerUsuario(Request $request)
    {
        try {
            return ParceiroService::removerUsuario($request->all());
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
