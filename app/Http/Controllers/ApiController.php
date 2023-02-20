<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\ParametroService;
use App\Services\ParceiroService;
use App\Services\SolicitacaoService;
use App\Services\UsuarioService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    
    public function atualizarUsuario(Request $request)
    {
        try {
            $user = UsuarioService::updateApi($request->all());
            return new UserResource($user);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => $th->getMessage()], 500);
        }
    }
    
    public function carregarDados(Request $request)
    {
        try {
            return response()->json([
                'data' => [
                    'totalizador' => [
                        'dados' => SolicitacaoService::totalizadores(),
                        'ultimaAtualizacao' => Carbon::now()->format('d/m/Y H:i:s')
                    ],
                    'dadosFormulario' => ParametroService::getParametrosFormularioApi(),
                    'tipoDestino' => SolicitacaoService::getTiposAtendimentos(),
                    'parceiros' => ParceiroService::getParceiros(true)->toArray()
                ]
            ]);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => $th->getMessage()], 500);
        }
    }

    public function solicitacao(Request $request)
    {
        try {
            SolicitacaoService::store($request->all());
            return response()->json(['mensagem' => 'Solicitação Recebida'], 201);
        } catch (\Throwable $th) {
            return response()->json(['mensagem' => $th->getMessage() . "|" . $th->getFile()."|".$th->getLine(),
            'status' => false], 500);
        }
    }
}
