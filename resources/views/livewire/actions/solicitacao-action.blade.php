<div class="dropdown mr-1 show">
    <button type="button" class="btn btn-secondary btn-sm dropdown-toggle btn-rounded"
        id="menuButton" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="true"
    >
        Ações
    </button>
    <div class="dropdown-menu" aria-labelledby="menuButton"
    x-placement="top-start"
    style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(10px, -172px, 0px);"
    >
        <a class="dropdown-item solicitacao_mapa" href="javascript:;"
            data-latitude="{{$latitude}}" data-longitude="{{$longitude}}"
        >
            <em class="fas fa-map"></em> Ver no Mapa
        </a>
        <a class="dropdown-item" href="javascript:;"
            wire:click="$emit('infoSolicitacao', '{{$id}}')"
        >
            <em class="fas fa-info"></em> Informações
        </a>
    </div>
</div>
