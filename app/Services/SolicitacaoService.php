<?php

namespace App\Services;

use App\Models\Solicitacao;
use Illuminate\Support\Collection;

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
}