<div id="sidebar" class="collapse d-none d-md-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 240px;">
    <div id="image" style="margin-left: 15%">
        <a href="{{ route('home') }}"><img src="{{ asset('images/AlphaLanches-Logo.png') }}" height="78px"
                alt="Logo Alpha"></a>
    </div>

    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        @if (auth()->user()->type === 'admin')
            <li class="nav-item">
                <a href="/financeiro" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-cash-coin fs-5 me-2"></i> Financeiro
                </a>
            </li>
            <li class="nav-item">
                <a href="/painelUsuarios" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-people fs-5 me-2"></i> Usuários
                </a>
            </li>
            <li class="nav-item">
                <a href="/responsaveis/" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-journal-plus fs-5 me-2"></i> Pedidos de Responsáveis
                </a>
            </li>
        @endif

        @if (in_array(auth()->user()->type, ['admin', 'func']))
            <li class="nav-item">
                <a href="/estoque" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-box fs-5 me-2"></i> Estoque
                </a>
            </li>
            <li class="nav-item">
                <a href="/HistoricoDeCompras" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-basket3 fs-5 me-2"></i> Histórico de Compras
                </a>
            </li>
            <li class="nav-item">
                <a href="/pedidosReservados" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-basket3 fs-5 me-2"></i> Pedidos Reservados
                </a>
            </li>
            <li class="nav-item">
                <a href="/pdv" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-shop fs-5 me-2"></i> PDV
                </a>
            </li>
        @endif

        @if (in_array(auth()->user()->type, ['guard']))
            <li class="nav-item">
                <a href="/HistoricoDeCompras" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-basket3 fs-5 me-2"></i> Histórico de Compras
                </a>
            </li>

            <li class="nav-item">
                <a href="/painelStudents" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-people fs-5 me-2"></i> Alunos
                </a>
            </li>
        @endif

        @if (in_array(auth()->user()->type, ['admin', 'func', 'guard', 'student']))
            <li class="nav-item">
                <a href="/profile" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-person fs-5 me-2"></i> Perfil
                </a>
            </li>
        @endif

        @if (in_array(auth()->user()->type, ['admin', 'guard']))
            <li class="nav-item">
                <a href="/recarga" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-wallet fs-5 me-2"></i> Recarga
                </a>
            </li>
        @endif

        @if (in_array(auth()->user()->type, ['guard', 'student']))
            <li class="nav-item">
                <a href="/agendamento" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-calendar-event fs-5 me-2"></i> Agendamento
                </a>
            </li>
        @endif

        @if (auth()->user()->type === 'student')
            <li class="nav-item">
                <a href="/PainelHistorico" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-basket3 fs-5 me-2"></i> Histórico de Compras
                </a>
            </li>
        @endif
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