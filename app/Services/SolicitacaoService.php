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
    /**
     * Buscar solicitações por status
     *
     * @param string $status
     * @return Collection|null
     */
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

    /**
     * Store solicitação
     *
     * @param array $request
     * @return Solicitacao|null
     */
    public static function store(array $request) : ?Solicitacao
    {
        DB::beginTransaction();
        try {
            $moradorRua = MoradorRuaService::store($request);
            MoradorRuaService::storeIdentificacao($moradorRua);
            MoradorRuaService::storeOutrasInformacoes($moradorRua);
            $solicitacao = Solicitacao::create([
                'morador_rua_id' => $moradorRua->id,
                'status_solicitacao_id' => StatusSolicitacao::where('nome', 'aberto')->first()->id,
                'tipo_destino_id' => TipoDestino::where('nome', $request['tipoDestino'])->first()->id,
                'solicitante_id' => $request['user_id'],
                'geo_lat' => $request['latitude'],
                'geo_lon' => $request['longitude']
            ]);
            DB::commit();
            return $solicitacao;
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Retorna os tipos de atendimentos
     *
     * @return array
     */
    public static function getTiposAtendimentos(): array
    {
        try {
            return TipoDestino::all()->pluck('descricao', 'nome')->toArray();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Retorna o total de solicitações
     *
     * @return array
     */
    public static function totalizadores(): array
    {
        $status = StatusSolicitacao::where('nome', 'encaminhado')->first();
        $statusCancelado = StatusSolicitacao::where('nome', 'cancelado')->first();
        return [
            'total' => Solicitacao::where('status_solicitacao_id', '!=', $statusCancelado->id)->get()->count(),
            'encaminhados' => Solicitacao::where('status_solicitacao_id', $status->id)->get()->count()
        ];
    }
}
