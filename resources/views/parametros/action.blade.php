<div class="dropdown mr-1 show">
    <button type="button" class="btn-sm btn btn-secondary dropdown-toggle btn-rounded"
        id="menuButton" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="true"
    >
        Ações
    </button>
    <div class="dropdown-menu btdrp" aria-labelledby="menuButton" x-placement="top-start">
        <button type="button" class="dropdown-item" data-id="{{$id}}" data-valor="{{ $valor }}"
            data-toggle="modal" data-target="#parametroModal">
            <em class="fas fa-pen-square"></em> Editar
        </button>
        <button class="dropdown-item delete-valor" data-id="{{$id}}">
            <em class="fas fa-trash"></em> Apagar
        </button>
    </div>
</div>
