<div class="dropdown">
    <a href="javascript:;" class="btn bg-gradient-dark dropdown-toggle btn-sm px-1 py-1" data-bs-toggle="dropdown" id="action-solicitacoes">
        Ações
    </a>
    <ul class="dropdown-menu" aria-labelledby="action-solicitacoes">
        <li>
            <a class="dropdown-item solicitacao_mapa" href="javascript:;" data-latitude="{{$latitude}}" data-longitude="{{$longitude}}" >
                <i class="fas fa-map"></i> Ver no Mapa
            </a>
        </li>
        <li>
            <a class="dropdown-item" href="javascript:;"  wire:click="$emit('infoSolicitacao', '{{$id}}')" >
                <i class="fas fa-info"></i> Informações
            </a>
        </li>
        
    </ul>
</div>