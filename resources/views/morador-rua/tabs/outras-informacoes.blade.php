{!! Form::model(
    $morador->outraInformacao,
    [
        'route' => ['morador-rua.outras-informacoes', $morador->outraInformacao->id],
        'method' => 'PUT'
    ]) !!}
<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Alguma doença?</h6>
    </div>
    <div class="col-sm-9 text-secondary">
        {!! Form::select(
            'alguma_doenca',
            [
                0 => 'Não',
                1 => 'Sim'
            ],
            null,
            ['id' => 'alguma_doenca', 'class' => 'form-control', 'required' => 'required']
        ) !!}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Doença</h6>
    </div>
    <div class="col-sm-9 text-secondary">
    {!! Form::text(
        'doenca_atual',
        null,
        ['class' => 'form-control', 'required' => 'required']
    ) !!}
    </div>
</div>
<hr>
<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Relatório Médico</h6>
    </div>
    <div class="col-sm-9 text-secondary">
    {!! Form::textarea(
        'relatorio_medico',
        null,
        ['class' => 'form-control', 'required' => 'required']
    ) !!}
    </div>
</div>
<button class="btn btn-success"><em class="fas fa-save"></em> Salvar</button>
{!! Form::close() !!}
