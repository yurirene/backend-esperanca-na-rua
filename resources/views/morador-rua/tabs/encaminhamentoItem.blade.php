<div class="tracking-item">
    <div class="tracking-icon status-intransit">
        <i class="fas fa-exchange-alt"></i>
    </div>
    <div class="tracking-date">
        {{$dado['data_formatada']}}
        <span>{{ $dado['hora_formatada'] }}</span>
    </div>
    <div class="tracking-content">
        Encaminhamento
        <span>
        Encaminhado para "{{ $dado['nome_parceiro'] }}", pelo usuário {{ $dado['encaminhado_por'] }}
        </span>
    </div>
</div>
