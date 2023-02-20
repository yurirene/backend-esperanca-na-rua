{!! Form::model(
    $morador->identificacao,
    [
        'route' => ['morador-rua.identificacao', $morador->identificacao->id],
        'method' => 'PUT'
    ]) !!}
<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Tem Documento?</h6>
    </div>
    <div class="col-sm-9 text-secondary">
        {!! Form::select(
            'tem_documento',
            [
                0 => 'N�o',
                1 => 'Sim'
            ],
            null,
            ['id' => 'tem_documento', 'class' => 'form-control', 'required' => 'required']
        ) !!}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Tipo do Documento</h6>
    </div>
    <div class="col-sm-9 text-secondary">
    {!! Form::text(
        'tipo_documento',
        null,
        ['class' => 'form-control', 'required' => 'required']
    ) !!}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Número Documento</h6>
    </div>
    <div class="col-sm-9 text-secondary">
    {!! Form::text(
        'numero_documento',
        null,
        ['class' => 'form-control', 'required' => 'required']
    ) !!}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Data Nascimento</h6>
    </div>
    <div class="col-sm-9 text-secondary">
    {!! Form::text(
        'data_nascimento',
        null,
        ['class' => 'form-control', 'required' => 'required']
    ) !!}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Cidade Natal</h6>
    </div>
    <div class="col-sm-9 text-secondary">
    {!! Form::text(
        'cidade_natal',
        null,
        ['class' => 'form-control', 'required' => 'required']
    ) !!}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Estado</h6>
    </div>
    <div class="col-sm-9 text-secondary">
    {!! Form::text(
        'estado_natal',
        null,
        ['class' => 'form-control', 'required' => 'required']
    ) !!}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Familiar - Nome</h6>
    </div>
    <div class="col-sm-9 text-secondary">
    {!! Form::text(
        'nome_familiar',
        null,
        ['class' => 'form-control', 'required' => 'required']
    ) !!}
    </div>
</div>
<hr>
<div class="row mb-3">
    <div class="col-sm-3">
        <h6 class="mb-0">Familiar - Contato</h6>
    </div>
    <div class="col-sm-9 text-secondary">
    {!! Form::text(
        'contato_familiar',
        null,
        ['class' => 'form-control', 'required' => 'required']
    ) !!}
    </div>
</div>
<button class="btn btn-success"><em class="fas fa-save"></em> Salvar</button>
{!! Form::close() !!}
