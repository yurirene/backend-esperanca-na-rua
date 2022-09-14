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
                                        {{ $solicitacao ? $solicitacao ? $solicitacao->morador->nome : null : null }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Gênero</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$solicitacao ? $solicitacao->morador->genero : null == 'M' ? 'Masculino' : 'Feminino'}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Faixa Etária</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$solicitacao ? $solicitacao->morador->faixa_idade : null}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tempo de Rua</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{$solicitacao ? $solicitacao->morador->tempo_rua : null ?? 'Não Informado'}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Passagem pela Polícia</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ ($solicitacao && $solicitacao->morador->passagemPolicia) ? $solicitacao->morador->passagemPolicia->descricao  : null}}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tem documento? Se sim, qual?</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $solicitacao ? ($solicitacao->morador->tem_documento  ? 'Sim, ' : 'Não') : null }}
                                        {{ $solicitacao ? ($solicitacao->morador->tem_documento ? ($solicitacao ? $solicitacao->morador->tipo_documento : null) : null  . ': ' . $solicitacao ? $solicitacao->morador->numero_documento : null) : ''  }}
                                    </div>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Condição Física</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        @if(!is_null($solicitacao ? $solicitacao->morador->condicao_fisica : null))
                                            @foreach ($solicitacao->morador->condicao_fisica as $key => $condicao)
                                                <span class="badge bg-gradient-info">{{ $key }} : {{ $condicao }}</span>
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
                                        {{ $solicitacao ? ($solicitacao->morador->doenca_atual ?? 'Não Informado' ) : null }}
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
