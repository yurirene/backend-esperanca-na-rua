<?php

namespace App\Services;

use App\Models\Modulo;
use App\Models\Perfil;
use App\Models\Rotas;
use App\Models\Solicitacao;
use App\Models\StatusSolicitacao;
use App\Models\TipoDestino;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PerfilService
{
    /**
     * Listar Perfis para input select
     *
     * @return array
     */
    public static function getPerfisParaSelect(): array
    {
        try {
            return Perfil::when(!auth()->user()->is_super, function ($sql) {
                return $sql->whereNotIn('name', [
                    'administrador',
                    'acesso_externo',
                    'operador_chamados'
                ]);
            })
            ->get()
            ->pluck('nome', 'id')
            ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Salvar novo Perfil
     *
     * @param array $request
     * @return Perfil|null
     */
    public static function store(array $request): ?Perfil
    {
        try {
            return Perfil::create([
                'nome' => $request['nome'],
                'name' => $request['name']
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Buscar perfil pelo name
     *
     * @param string $perfil
     * @return array
     */
    public static function getPerfil(string $perfil): array
    {
        try {
            return Perfil::where('name', $perfil)->first()->toArray();
        } catch (\Throwable $th) {
            return [];
        }
    }

    /**
     * Lista todos as rotas selecionadas por perfil
     *
     * @return array
     */
    public static function getPerfilRota(): array
    {
        try {
            $modulos = Modulo::where('name', '!=', 'acessos')->get();
            $perfis = Perfil::get();
            $retorno = [];
            foreach ($perfis as $perfil) {
                $rotasPerfil = $perfil->rotas->pluck('id')->toArray();
                $retorno[$perfil->id]['nome'] = $perfil->nome;
                $retorno[$perfil->id]['id'] = $perfil->id;
                foreach ($modulos as $key => $modulo) {
                    $retorno[$perfil->id]['rotas'][$modulo->id]['nome']  = $modulo->nome;
                    foreach ($modulo->rotas as $rota) {
                        $retorno[$perfil->id]['rotas'][$modulo->id]['rotas'][]  = [
                            'id' => $rota->id,
                            'nome' => $rota->nome,
                            'uri' => $rota->uri,
                            'checked' => in_array($rota->id, $rotasPerfil)
                        ];
                    }
                }
            }
            return $retorno;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public static function atualizarRota(array $request): bool
    {
        try {
            $perfil = Perfil::find($request['perfil_id']);
            if ($request['checked'] == 'ativo') {
                $perfil->rotas()->attach($request['rota_id']);
            } else {
                $perfil->rotas()->detach($request['rota_id']);
            }
            return true;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
