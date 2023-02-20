<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApi
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->has(['user_id', 'key'])) {
            return response()->json(['message' => 'Informe o user_id e a key'], 400);
        }
        $user = User::find($request->user_id);
        if (!$user) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }
        if (!Hash::check($user->id.$user->password, $request->key)) {
            return response()->json(['message' => 'Não Autorizado'], 401);
        }
        return $next($request);
    }
}
