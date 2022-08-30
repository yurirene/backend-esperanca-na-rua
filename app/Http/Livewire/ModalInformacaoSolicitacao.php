<?php

namespace App\Http\Livewire;

use App\Models\Solicitacao;
use Livewire\Component;

class ModalInformacaoSolicitacao extends Component
{
    public $solicitacao;

    protected $listeners = ['infoSolicitacao'];
  
    public function mount()
    {
      $this->solicitacao = Solicitacao::first();
    }
    
     public function infoSolicitacao($solicitacaoId)
     {
         $this->solicitacao = Solicitacao::find($solicitacaoId); 
     }

    public function render()
    {
        return view('livewire.modal-informacao-solicitacao', [
            'solicitacao' => $this->solicitacao
        ]);
    }
}
