<nav class="sidebar-nav" aria-label="menu-lateral">
    <ul id="sidebarnav">
        <li class="sidebar-item">
            <a class="sidebar-link sidebar-link" href="{{ route('dashboard.index') }}" aria-expanded="false">
                <em data-feather="home" class="feather-icon"></em>
                <span class="hide-menu">Dashboard</span>
            </a>
        </li>
        <li class="list-divider"></li>
        <li class="nav-small-cap"><span class="hide-menu">Atendimento</span></li>
        @can('menu', 'morador-rua.index')
        <li class="sidebar-item">
            <a class="sidebar-link" href="{{ route('morador-rua.index') }}" aria-expanded="false">
                <em data-feather="users" class="feather-icon"></em>
                <span class="hide-menu">
                    Moradores de Rua
                </span>
            </a>
        </li>
        @endcan
        @can('menu', 'parceiros.index')
        <li class="sidebar-item">
            <a class="sidebar-link sidebar-link" href="{{ route('parceiros.index') }}" aria-expanded="false">
                <em data-feather="cpu" class="feather-icon"></em>
                <span class="hide-menu">Parceiros</span>
            </a>
        </li>
        @endcan

        <li class="list-divider"></li>
        <li class="nav-small-cap"><span class="hide-menu">Administração</span></li>
        @can('menu', 'usuarios.index')
        <li class="sidebar-item">
            <a class="sidebar-link sidebar-link" href="{{ route('usuarios.index') }}" aria-expanded="false">
                <em data-feather="user-check" class="feather-icon"></em>
                <span class="hide-menu">Usuários</span>
            </a>
        </li>
        @endcan
        @can('menu', 'configuracoes.parceiros.index')
        <li class="sidebar-item">
            <a class="sidebar-link has-arrow" href="javascript:void(0)" aria-expanded="false">
                <em data-feather="settings" class="feather-icon"></em>
                <span class="hide-menu">Configurações </span>
            </a>
            <ul aria-expanded="false" class="collapse  first-level base-level-line">
                <li class="sidebar-item">
                    <a href="{{ route('configuracoes.parceiros.index') }}" class="sidebar-link">
                        <em data-feather="cpu" class="feather-icon"></em>
                        <span class="hide-menu"> Parceiros </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('configuracoes.usuarios.index') }}" class="sidebar-link">
                        <em data-feather="user-check" class="feather-icon"></em>
                        <span class="hide-menu"> Usuários </span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('configuracoes.parametros.index' )}}" class="sidebar-link">
                        <em data-feather="key" class="feather-icon"></em>
                        <span class="hide-menu"> Parâmetros </span>
                    </a>
                </li>
            </ul>
        </li>
        @endcan
        @if(auth()->user()->is_super)
        <li class="sidebar-item">
            <a class="sidebar-link sidebar-link" href="{{ route('perfil.index') }}" aria-expanded="false">
                <em data-feather="shield" class="feather-icon"></em>
                <span class="hide-menu">Perfis</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
