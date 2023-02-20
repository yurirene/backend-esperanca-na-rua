<?php

namespace App\Services;

use App\Models\Parceiro;
use App\Models\TipoParceiro;
use App\Models\User;
use Illuminate\Support\Collection;

class ParceiroService
{
    public const ATIVO = 1;
    public const INATIVO = 0;
    public const STATUS = [
        self::ATIVO => 'Ativo',
        self::INATIVO => 'Inativo',
    ];

    /**
     * Listar Parceiros
     *
     * @return Collection
     */
    public static function getParceiros(bool $somenteDisponiveis = false): Collection
    {
        return Parceiro::when($somenteDisponiveis, function ($sql) {
            return $sql->where('disponivel', true);
        })
        ->get();
    }

    /**
     * Listar parceiros para input select
     *
     * @return array
     */
    public static function getParceirosForSelect(): array
    {
        return Parceiro::get()->pluck('nome', 'id')->toArray();
    }

    /**
     * Listar Tipos de Parceiros para input select
     *
     * @return array
     */
    public static function getTiposParceirosForSelect(): array
    {
        return TipoParceiro::all()->pluck('nome', 'id')->toArray();
    }

    /**
     * Salvar Parceiro
     *
     * @param array $request
     * @return Parceiro|null
     * @throws Exception
     */
    public static function store(array $request): ?Parceiro
    {
        try {
            return Parceiro::create([
                'nome' => $request['nome'],
                'cpf_cnpj' => $request['cpf_cnpj'],
                'tipo_parceiro_id' => $request['tipo_parceiro_id'],
                'endereco' => $request['endereco'],
                'telefone_principal' => $request['telefone_principal'],
                'telefone_secundario' => $request['telefone_secundario'] ?? null
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Atualizar Parceiro
     *
     * @param Parceiro $parceiro
     * @param array $request
     * @return Parceiro|null
     * @throws Exception
     */
    public static function update(Parceiro $parceiro, array $request): ?Parceiro
    {
        try {
            $parceiro->update([
                'nome' => $request['nome'],
                'cpf_cnpj' => $request['cpf_cnpj'],
                'tipo_parceiro_id' => $request['tipo_parceiro_id'],
                'endereco' => $request['endereco'],
                'telefone_principal' => $request['telefone_principal'],
                'telefone_secundario' => $request['telefone_secundario']
            ]);
            return $parceiro;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Inverter Status do Parceiro
     *
     * @param Parceiro $parceiro
     * @return void
     * @throws Exception
     */
    public static function status(Parceiro $parceiro): void
    {
        try {
            $parceiro->update([
                'ativo' => !$parceiro->ativo
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Alterar Estado de Disponibilidade
     *
     * @param Parceiro $parceiro
     * @param array $request
     * @return Parceiro|null
     */
    public static function disponivel(Parceiro $parceiro, array $request): ?Parceiro
    {
        try {
            $parceiro->update([
                'disponivel' => $request['disponivel']
            ]);
            return $parceiro;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * DataTable de Usuários dos Parceiros
     *
     * @param Parceiro $parceiro
     * @return void
     * @throws Exception
     */
    public static function usuariosParceiro(Parceiro $parceiro)
    {
        try {
            $usuarios = $parceiro->usuarios->map(function ($item) {
                return [
                    'id' => $item->id,
                    'nome' => $item->name,
                    'email' => $item->email,
                    'perfil' => $item->role
                ];
            });
            return datatables()::of($usuarios)->make();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    /**
     * Listar Usuários não relacionados com o parceiro
     *
     * @param int $parceiro
     * @return array
     * @throws Exception
     */
    public static function getUsuariosNaoRelacionadosSelect(int $parceiro): array
    {
        try {
            return User::where(function ($query) use ($parceiro) {
                return $query->whereHas('parceiros', function ($sql) use ($parceiro) {
                    return $sql->where('parceiro_id', '!=', $parceiro);
                })
                ->orWhereDoesntHave('parceiros');
            })
            ->get()
            ->map(function ($item) {
                return [
                    'id' => $item->id,
                    'text' => $item->name
                ];
            })
            ->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Salvar novo usuário relacionado ao Parceiro
     *
     * @param array $request
     * @return void
     */
    public static function relacionarUsuarios(array $request): void
    {
        try {
            $parceiro = Parceiro::findOrFail($request['parceiro_id']);
            $usuarios = array_merge(
                $request['usuarios'],
                $parceiro->usuarios->pluck('id')->toArray()
            );
            $parceiro->usuarios()->sync($usuarios);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Remover usuário relacionado ao parceiro
     *
     * @param array $request
     * @return void
     * @throws Exception
     */
    public static function removerUsuario(array $request): void
    {
        try {
            $parceiro = Parceiro::findOrFail($request['parceiro_id']);
            $parceiro->usuarios()->detach($request['user_id']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
