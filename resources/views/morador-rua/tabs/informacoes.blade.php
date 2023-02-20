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
        {{ $morador->genero }}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Faixa Etária</h6>
    </div>
    <div class="col-sm-9 text-secondary">
        {{ $morador->faixa_etaria ?? 'Não Informado' }}
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
        {{ $morador->passagem_policia ?? 'Não Informado'}}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Condição Física - Limpeza</h6>
    </div>
    <div class="col-sm-9 text-secondary">
        {{ $morador->limpeza ?? 'Não Informado'}}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-sm-3">
        <h6 class="mb-0">Condição Física - Sobriedade</h6>
    </div>
    <div class="col-sm-9 text-secondary">
        {{ $morador->sobriedade ?? 'Não Informado'}}
    </div>
</div>
