@extends('layouts.template')
@section('header', 'Morador de Rua')
@section('cabecalho', 'Morador de Rua > Visualizar')

@section('conteudo')
<div class="row gutters-sm">
    <div class="col-md-3 mb-sm-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="row d-flex align-items-center justify-content-center">
                    <div class="col">
                        <img src="{{ '/' . $morador->foto }}"
                        alt="Admin" class="img-fluid" width="auto">
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-12">
                        <button type="button" class="btn btn-sm btn-secondary dropdown-toggle btn-rounded btn-block"
                            id="menuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="true"
                        >
                            Ações
                        </button>
                        <div class="dropdown-menu btdrp" aria-labelledby="menuButton" x-placement="top-start">
                            @can('menu', 'morador-rua.encaminhar')
                            <button class="dropdown-item" data-toggle="modal"
                                data-target="#encaminhar-modal">
                                <em class="fas fa-sign-in-alt"></em>
                                Encaminhar
                            </button>
                            @endcan
                            <button class="dropdown-item" data-toggle="modal"
                                data-target="#alterar-foto-modal">
                                <em class="fas fa-camera"></em>
                                Alterar Foto
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-9">
        <div class="card mb-3 h-100">
            <div class="card-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab"
                            data-toggle="tab" data-target="#informacoes" type="button"
                            role="tab" aria-controls="informacoes" aria-selected="true"
                        >
                            Solicitação
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="home-tab"
                            data-toggle="tab" data-target="#identificacao" type="button"
                            role="tab" aria-controls="identificacao" aria-selected="true"
                        >
                            Identificação
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="home-tab"
                            data-toggle="tab" data-target="#outras-informacoes" type="button"
                            role="tab" aria-controls="outras-informacoes" aria-selected="true"
                        >
                            Outras Informações
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="encaminhamento-tab"
                            data-toggle="tab" data-target="#encaminhamento" type="button"
                            role="tab" aria-controls="encaminhamento" aria-selected="true"
                        >
                           Encaminhamentos
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="home-tab"
                            data-toggle="tab" data-target="#historico" type="button"
                            role="tab" aria-controls="historico" aria-selected="true"
                        >
                           Histórico
                        </button>
                    </li>
                </ul>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane p-3 fade show active"
                        id="informacoes" role="tabpanel" aria-labelledby="informacoes-tab"
                    >
                    @include('morador-rua.tabs.informacoes')
                    </div>
                    <div class="tab-pane p-3 fade"
                        id="identificacao" role="tabpanel" aria-labelledby="identificacao-tab"
                    >
                    @include('morador-rua.tabs.identificacao')
                    </div>
                    <div class="tab-pane p-3 fade"
                        id="outras-informacoes" role="tabpanel" aria-labelledby="outras-informacoes-tab"
                    >
                    @include('morador-rua.tabs.outras-informacoes')
                    </div>
                    <div class="tab-pane p-3 fade"
                        id="encaminhamento" role="tabpanel" aria-labelledby="encaminhamento-tab"
                    >
                    @include('morador-rua.tabs.encaminhamento')
                    </div>
                    <div class="tab-pane p-3 fade"
                        id="historico" role="tabpanel" aria-labelledby="historico-tab"
                    >
                    @include('morador-rua.tabs.historico')
                    </div>
                </div>
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
            {!! Form::open(['method' => 'POST', 'url' => route('morador-rua.encaminhar')]) !!}
            <div class="modal-body">
                <div class="form-group">
                    {!! Form::label('parceiro_id', 'Parceiro') !!}
                    {!! Form::select(
                        'parceiro_id',
                        $parceiros,
                        null,
                        ['class' => 'form-control', 'required' => 'required']
                    ) !!}
                    <input type="hidden" name="morador_rua_id" value="{{ $morador->id }}" />
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Encaminhar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<!-- Modal Alterar Foto -->
<div class="modal fade" id="alterar-foto-modal"
    tabindex="-1" aria-labelledby="alterar-foto-modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="alterar-foto-modalLabel">Alterar Foto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open([
                'method' => 'PUT',
                'url' => route('morador-rua.alterar-foto', $morador->id),
                'files' => true
            ]) !!}
            <div class="modal-body">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="foto" id="foto">
                    <label class="custom-file-label" for="foto">Escolher Foto</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Alterar</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
