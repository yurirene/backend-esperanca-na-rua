<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\PerfilService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginApiController extends Controller
{
    public function login(Request $request)
    {
        $usuario = User::where([
            'email' => $request->email,
            'ativo' => true,
            'perfil_id' => PerfilService::getPerfil('operador_externo')['id']
        ])
        ->first();
        if (!$usuario) {
            return response()->json([
                'mensagem' => 'Login Inválido'
            ], 401);
        }
        if (!Hash::check($request->password, $usuario->password)) {
            return response()->json([
                'mensagem' => 'Login Inválido'
            ], 401);
        }
        return new UserResource($usuario);
    }
}
