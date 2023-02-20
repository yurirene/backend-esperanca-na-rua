<?php

namespace App\Services;

use App\Models\User;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UsuarioService
{
    
    /**
     * Salva novo Usuário
     *
     * @param array $request
     * @return User|null
     */
    public static function store(array $request): ?User
    {
        try {
            return User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'perfil_id' => $request['perfil_id'],
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Atualiza Usuário
     *
     * @param User $usuario
     * @param array $request
     * @return User|null
     */
    public static function update(User $usuario, array $request): ?User
    {
        try {
            $usuario->update([
                'name' => $request['name'],
                'email' => $request['email'],
                'perfil_id' => $request['perfil_id'],
            ]);
            if (isset($request['password'])) {
                $usuario->update([
                    'password' => Hash::make($request['password']),
                ]);
            }
            return $usuario;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Altera Status do Usuário
     *
     * @param User $usuario
     * @return void
     */
    public static function status(User $usuario): void
    {
        try {
            $usuario->update([
                'ativo' => !$usuario->ativo
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update dados do usuário através do app
     *
     * @param array $request
     * @return User|null
     */
    public static function updateApi(array $request): ?User
    {
        try {
            $usuario = User::findOrFail($request['user_id']);
            if (isset($request['name'])) {
                $usuario->update([
                    'name' => $request['name'],
                ]);
            }
            if (
                isset($request['newPassword'])
                && isset($request['oldPassword'])
            ) {
                if (!Hash::check($request['oldPassword'], $usuario->password)) {
                    throw new Exception("Senha Incorreta", 1);
                }
                $usuario->update([
                    'password' => Hash::make($request['newPassword']),
                ]);
            }
            return $usuario;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    
    /**
     * Undocumented function
     *
     * @param string $id
     * @return User
     */
    public static function getUsuarioById(string $id): User
    {
        try {
            return User::findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => 'Erro ao buscar usuário'], 500);
        }
    }

}
