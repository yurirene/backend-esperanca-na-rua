<?php

namespace App\Http\Controllers;

use App\Services\SolicitacaoService;
use Illuminate\Http\Request;

class SolicitacaoController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = SolicitacaoService::store($request->all());
            return response()->json(['message' => 'Solicitação Recebida', 'status' => true, 'data' => $data->toArray()], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 500);
        }
    }

    public function getTiposAtendimentos()
    {
        try {
            return response()->json(SolicitacaoService::getTiposAtendimentos(), 200);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => false], 500);
        }
    }
}
