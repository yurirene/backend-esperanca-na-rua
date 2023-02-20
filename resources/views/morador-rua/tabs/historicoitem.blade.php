<div class="tracking-item">
    <div class="tracking-icon status-intransit">
        <i class="fas fa-history"></i>
    </div>
    <div class="tracking-date">
        {{$dado['data']}}
        <span>{{ $dado['hora'] }}</span>
    </div>
    <div class="tracking-content">
        {{ $dado['acao'] }}
        <span>Registro de {{ $dado['table'] }} - Campos alterados: {{ implode($dado['colunas'], ',') }}</span>
    </div>
</div>
