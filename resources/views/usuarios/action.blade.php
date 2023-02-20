<div class="dropdown mr-1 show">
    <button type="button" class="btn btn-sm btn-secondary dropdown-toggle btn-rounded"
        id="menuButton" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="true"
    >
        Ações
    </button>
    <div class="dropdown-menu btdrp" aria-labelledby="menuButton" x-placement="top-start">
        @if($editar)
        <a class="dropdown-item solicitacao_mapa" href="{{ route('usuarios.edit', $id) }}">
            <em class="fas fa-pen-square"></em> Editar
        </a>
        @endif

        @if($inativar)
        <a class="dropdown-item"  href="{{ route('usuarios.status', $id) }}">
            <em class="fas fa-{{$status ? 'exclamation-circle' : 'check-circle'}}"></em>
            {{ $status ? 'Inativar' : 'Ativar'}}
        </a>
        @endif
    </div>
</div>
