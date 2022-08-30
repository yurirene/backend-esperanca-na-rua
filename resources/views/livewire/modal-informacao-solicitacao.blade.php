<div wire:ignore.self  class="modal" id="modal-info-solicitacao" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informação</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="auto">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nome</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $solicitacao->morador->nome }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Gênero</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$solicitacao->morador->genero == 'M' ? 'Masculino' : 'Feminino'}} 
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Faixa Etária</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$solicitacao->morador->faixa_idade}} 
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tempo de Rua</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$solicitacao->morador->tempo_rua ?? 'Não Informado'}} 
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Passagem pela Polícia</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$solicitacao->morador->passagemPolicia->descricao}} 
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tem documento? Se sim, qual?</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $solicitacao->morador->tem_documento ? 'Sim, ' : 'Não' }}
                                        {{ $solicitacao->morador->tem_documento ? ($solicitacao->morador->tipo_documento . ': ' . $solicitacao->morador->numero_documento) : ''  }}
                                    </div>
                                </div>
                                <hr>
                                
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Condição Física</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if(!is_null($solicitacao->morador->condicao_fisica))
                                            @foreach ($solicitacao->morador->condicao_fisica as $condicao) 
                                                <span class="badge bg-gradient-info">{{ $condicao }}</span>
                                            @endforeach
                                        @else
                                            <span class="badge bg-gradient-info">Sem Informação</span>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Doença Atual</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $solicitacao->morador->doenca_atual ?? 'Não Informado' }}
                                    </div>
                                </div>
                                <hr>
                            </div>
                        </div>                        
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>