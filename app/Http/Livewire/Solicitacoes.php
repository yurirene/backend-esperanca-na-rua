<?php

namespace App\Http\Livewire;

use App\Models\Solicitacao;
use App\Services\SolicitacaoService;
use Livewire\Component;

class Solicitacoes extends Component
{
    public function render()
    {
        $solicitacoes = SolicitacaoService::getSolicitacaoPorStatus('aberto');
        return view('livewire.solicitacoes', compact('solicitacoes'));
    }
}
