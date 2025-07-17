  {{-- Sidebar Left--}}
  <aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{ route('home') }}">
                <i class="bi bi-house"></i>
                <span>Inicio</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('game.show') }}">
                <i class="bi bi-grid"></i>
                <span>Juegos</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link " href="{{ route('intro') }}">
                <i class="bi bi-info-circle"></i>
                <span>Conoce la Plataforma</span>
            </a>
        </li>
        @if(auth()->check() && auth()->user()->isSuper())
            <li class="nav-item">
                <a class="nav-link" href="{{ route('roles.index') }}">
                    <i class="bi bi-person-badge"></i>
                    <span>Roles</span>
                </a>
            </li>
        @endif
    </ul>
</aside>