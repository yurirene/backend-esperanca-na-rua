<?php

namespace App\Services;

use App\Models\Solicitacao;
use App\Models\StatusSolicitacao;
use App\Models\TipoDestino;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SolicitacaoService
{
    public static function getSolicitacaoPorStatus(string $status) : ?Collection
    {
        try {
            return Solicitacao::whereHas('status', function($sql) use ($status) {
                return $sql->where('nome', $status);
            })->get();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public static function store(array $request) : ?Solicitacao
    {
        DB::beginTransaction();
        try {
            $morador_rua = MoradorRuaService::store($request);
            DB::commit();
            return Solicitacao::create([
                'morador_rua_id' => $morador_rua->id,
                'status_solicitacao_id' => StatusSolicitacao::where('nome', 'aberto')->first()->id,
                'tipo_destino_id' => TipoDestino::where('nome', $request['tipo_destino'])->first()->id,
                'solicitante_id' => User::first()->id,
                'geo_lat' => $request['latitude'],
                'geo_lon' => $request['longitude']
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
            throw $th;
        }
    }
}
