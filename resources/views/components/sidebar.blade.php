<div id="sidebar" class="collapse d-none d-md-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 240px;">
    <!-- Logo -->
    <div id="image" style="margin-left: 15%">
        <a href="{{ route('home') }}">
            <img src="{{ asset('images/AlphaLanches-Logo.png') }}" height="78px" alt="Logo Alpha">
        </a>
    </div>

    <hr>

    <ul class="nav nav-pills flex-column mb-auto">
        {{-- ADMIN --}}
        @if (auth()->user()->type === 'admin')
            <li class="nav-item">
                <a href="{{ route('financeiro') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-cash-coin fs-5 me-2"></i> Financeiro
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('estoque') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-box fs-5 me-2"></i> Estoque
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pdv') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-shop fs-5 me-2"></i> PDV
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('historico') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-basket3 fs-5 me-2"></i> Histórico de Compras
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('historicoRecarga') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-receipt-cutoff fs-5 me-2"></i> Histórico de Recargas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('recarga') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-wallet fs-5 me-2"></i> Recarga
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('responsaveis') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-journal-plus fs-5 me-2"></i> Pedidos de Responsáveis
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('painelUsuarios') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-people fs-5 me-2"></i> Usuários
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-person fs-5 me-2"></i> Perfil
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pedidosReservados') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-bookmark fs-5 me-2"></i> Pedidos Reservados
                </a>
            </li>
        @endif

        {{-- FUNCIONÁRIO --}}
        @if (auth()->user()->type === 'func')
            <li class="nav-item">
                <a href="{{ route('estoque') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-box fs-5 me-2"></i> Estoque
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('pdv') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-shop fs-5 me-2"></i> PDV
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('historico') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-basket3 fs-5 me-2"></i> Histórico de Compras
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('historicoRecarga') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-receipt-cutoff fs-5 me-2"></i> Histórico de Recargas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('recarga') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-wallet fs-5 me-2"></i> Recarga
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('painelUsuarios') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-people fs-5 me-2"></i> Usuários
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-person fs-5 me-2"></i> Perfil
                </a>
            </li>
        @endif

        {{-- RESPONSÁVEL --}}
        @if (auth()->user()->type === 'guard')
            <li class="nav-item">
                <a href="{{ route('painelUsuarios') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-people fs-5 me-2"></i> Alunos
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('agendamento') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-calendar-event fs-5 me-2"></i> Agendamento
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('historico') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-basket3 fs-5 me-2"></i> Histórico de Compras
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('historicoRecarga') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-receipt-cutoff fs-5 me-2"></i> Histórico de Recargas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('recarga') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-wallet fs-5 me-2"></i> Recarga
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-person fs-5 me-2"></i> Perfil
                </a>
            </li>
        @endif

        {{-- ALUNO --}}
        @if (auth()->user()->type === 'student')
            <li class="nav-item">
                <a href="{{ route('agendamento') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-calendar-event fs-5 me-2"></i> Agendamento
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('historico') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-basket3 fs-5 me-2"></i> Histórico de Compras
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('historicoRecarga') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-receipt-cutoff fs-5 me-2"></i> Histórico de Recargas
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('recarga') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-wallet fs-5 me-2"></i> Recarga
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('profile') }}" class="nav-link text-white btn btn-secondary text-start">
                    <i class="bi bi-person fs-5 me-2"></i> Perfil
                </a>
            </li>
        @endif
    </ul>

    <hr>

    <!-- Perfil e Logout -->
    <div class="dropdown d-flex align-items-center">
        <img src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/photo_user_generic.png') }}"
            class="rounded-circle border" width="45" height="45" alt="Foto de Perfil" style="margin-right: 10px;">
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