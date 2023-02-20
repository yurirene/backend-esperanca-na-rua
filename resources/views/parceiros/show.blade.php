@extends('layouts.template')
@section('header', 'Morador de Rua')
@section('cabecalho', 'Morador de Rua > Visualizar')

@section('conteudo')
<div class="row gutters-sm">
    <div class="col-md-3 mb-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col">
                        <img src="/sitev2/assets/images/profile-img.jpg"
                        alt="Admin" class="rounded-circle img-fluid" width="auto">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col text-center">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#encaminhar-modal">
                            <em class="fas fa-sign-in-alt"></em>
                            Encaminhar
                        </button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#historico-modal">
                            <em class="fas fa-history"></em>
                            Histórico
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Nome</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $morador->nome }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Gênero</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $morador->genero == 'M' ? 'Masculino' : 'Feminino'}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Faixa Etária</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $morador->faixa_idade ?? 'Não Informado' }}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Tempo de Rua</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $morador->tempo_rua ?? 'Não Informado'}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Passagem pela Polícia</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $morador->passagemPolicia ? $morador->passagemPolicia->descricao : null}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Tem documento? Se sim, qual?</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $morador->tem_documento  ? 'Sim, ' : 'Não' }}
                        {{$morador->tem_documento ? $morador->tipo_documento . ' - ' . $morador->numero_documento : ''}}
                    </div>
                </div>
                <hr>

                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Condição Física</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        @if(!is_null($morador->condicao_fisica))
                        @foreach ($morador->condicao_fisica as $key => $condicao)
                        <span class="badge badge-pill badge-info">{{ $key }} : {{ $condicao }}</span>
                        @endforeach
                        @else
                        <span class="badge badge-pill badge-info">Sem Informação</span>
                        @endif
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <h6 class="mb-0">Doença Atual</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                        {{ $morador->doenca_atual ?? 'Não Informado' }}
                    </div>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="encaminhar-modal" tabindex="-1" aria-labelledby="encaminhar-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="encaminhar-modalLabel">Encaminhar Morador de Rua</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['method' => 'POST', 'url' => route('morador-rua.encaminhar', $morador->id)]) !!}

                <div class="form-group">
                    {!! Form::label('parceiro_id', 'Parceiro') !!}
                    {!! Form::select('parceiro_id', $parceiros, null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
                {!! Form::close() !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Encaminhar</button>
            </div>
        </div>
    </div>
</div>

@endsection
