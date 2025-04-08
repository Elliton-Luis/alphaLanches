<div id="sidebar" class="collapse d-none d-md-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 240px;">
    <div id="image" style="margin-left: 15%">
    <a href="{{ route('home') }}"><img src="{{ asset('images/AlphaLanches-Logo.png') }}" height="78px" alt="Logo Alpha"></a>
    </div>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">

    </ul>

    <hr>

    <div class="dropdown d-flex align-items-center">
        <img src={{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/photo_user_generic.png') }} class="rounded-circle border" width="45" height="45"
            alt="Foto de Perfil" style="margin-right: 10px;">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <strong style="font-size: 19px;">{{ auth()->user()->name ?? 'Usuário' }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li>
                <form id="logout-form" action="{{ route('login.logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="dropdown-item" href="#"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Sair
                </a>
            </li>
        </ul>
    </div>
</div>