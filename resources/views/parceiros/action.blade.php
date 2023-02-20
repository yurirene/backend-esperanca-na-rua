<div class="dropdown mr-1 show">
    <button type="button" class="btn-sm btn btn-secondary dropdown-toggle btn-rounded"
        id="menuButton" data-toggle="dropdown" aria-haspopup="true"
        aria-expanded="true"
    >
        Ações
    </button>
    <div class="dropdown-menu btdrp" aria-labelledby="menuButton" x-placement="top-start">
        <button type="button" class="dropdown-item" data-id="{{$id}}"
            data-toggle="modal" data-target="#usuarioModal">
            <em class="fas fa-users"></em> Usuários
        </button>
        @if($editar)
        <a class="dropdown-item" href="{{ route('parceiros.edit', $id) }}">
            <em class="fas fa-pen-square"></em> Editar
        </a>
        @endif
        @if($inativar)
        <a class="dropdown-item"  href="{{ route('parceiros.status', $id) }}">
            <em class="fas fa-{{$status ? 'exclamation-circle' : 'check-circle'}}"></em>
            {{ $status ? 'Inativar' : 'Ativar'}}
        </a>
        @endif
    </div>
</div>
