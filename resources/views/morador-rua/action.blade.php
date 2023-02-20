<div class="dropdown mr-1 show">
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle btn-rounded"
        id="menuButton" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="true"
    >
        Ações
    </button>
    <div class="dropdown-menu btdrp" aria-labelledby="menuButton" x-placement="top-start">
        @if($visualizar)
        <a class="dropdown-item" href="{{ route('morador-rua.show', $id) }}">
            <em class="fas fa-eye"></em> Visualizar
        </a>
        @endif
        @if($deletar)
        <a class="dropdown-item"  href="{{ route('morador-rua.delete', $id) }}">
            <em class="fas fa-trash"></em> Apagar
        </a>
        @endif
    </div>
</div>
