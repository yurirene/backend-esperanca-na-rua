<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use App\Services\PerfilService;
use App\Services\UsuarioService;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(UsersDataTable $dataTable)
    {
        try {
            session()->put('is_configuracao', false);
            return $dataTable->render('usuarios.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar');
        }
    }

    public function create()
    {
        try {
            return view('usuarios.form', [
                'perfis' => PerfilService::getPerfisParaSelect(),
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao Carregar Formulário');
        }
    }

    public function store(Request $request)
    {
        try {
            UsuarioService::store($request->all());
            $route = session()->get('is_configuracao')
                ? 'configuracoes.usuarios.index'
                : 'usuarios.index';
            return redirect()->route($route)
                ->with('sucesso', 'Usuário cadastrado com sucesso!');;
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao salvar Usuário');
        }
    }

    public function edit(User $usuario)
    {
        try {
            return view('usuarios.form', [
                'usuario' => $usuario,
                'perfis' => PerfilService::getPerfisParaSelect(),
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao carregar formulário');
        }
    }

    public function update(User $usuario, Request $request)
    {
        try {
            UsuarioService::update($usuario, $request->all());
            $route = session()->get('is_configuracao')
                ? 'configuracoes.usuarios.index'
                : 'usuarios.index';
            return redirect()->route($route)
                ->with('sucesso', 'Usuário atualizado com sucesso!');;
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao atualizar usuário');
        }
    }

    public function status(User $usuario)
    {
        try {
            UsuarioService::status($usuario);
            $route = session()->get('is_configuracao')
                ? 'configuracoes.usuarios.index'
                : 'usuarios.index';
            return redirect()->route($route)
                ->with('sucesso', 'Status alterado com sucesso!');;
        } catch (\Throwable $th) {
            return redirect()->route('dashboard.index')
                ->with('erro', 'Erro ao alterar status do usuário');
        }
    }
}
