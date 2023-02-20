<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RolesMiddleware
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
        if (auth()->user()->is_super) {
            return $next($request);
        }
        if (!session()->has('routes')) {
            $rotas = auth()->user()->perfil->rotas->pluck('uri')->toArray();
            session()->put('routes', $rotas);
        }
        $rotasPermitidas = session()->get('routes');
        $rota = $request->route()->getName();
        if (!in_array($rota, $rotasPermitidas)) {
            return redirect()->route('dashboard.index')->with('nao_autorizado', true);
        }
        return $next($request);
    }
}
