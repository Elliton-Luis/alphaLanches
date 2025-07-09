<div class="d-block d-md-none container-fluid mb-2 text-bg-dark">
    <nav class="navbar py-2">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <!-- Botão Menu -->
            <div class="dropdown">
                <button class="btn btn-dark border-0 shadow-sm" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-list fs-3"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow rounded-3 mt-2">
                    @if (auth()->user()->type === 'admin')
                        <li>
                            <a href="/financeiro" class="dropdown-item btn btn-secondary text-start w-100">
                                <i class="bi bi-cash-coin me-2"></i> Financeiro
                            </a>
                        </li>
                        <li>
                            <a href="/painelUsuarios" class="dropdown-item btn btn-secondary text-start w-100 mt-1">
                                <i class="bi bi-people me-2"></i> Usuários
                            </a>
                        </li>
                        <li>
                            <a href="/responsaveis/" class="dropdown-item btn btn-secondary text-start w-100 mt-1">
                                <i class="bi bi-journal-plus me-2"></i> Pedidos
                            </a>
                        </li>
                    @endif

                    @if (in_array(auth()->user()->type, ['admin', 'func']))
                        <li>
                            <a href="/estoque" class="dropdown-item btn btn-secondary text-start w-100 mt-1">
                                <i class="bi bi-box me-2"></i> Estoque
                            </a>
                        </li>
                        <li>
                            <a href="/historico" class="dropdown-item btn btn-secondary text-start w-100 mt-1">
                                <i class="bi bi-basket3 me-2"></i> Histórico
                            </a>
                        </li>
                        <li>
                            <a href="/pdv" class="dropdown-item btn btn-secondary text-start w-100 mt-1">
                                <i class="bi bi-shop me-2"></i> PDV
                            </a>
                        </li>
                    @endif

                    @if (in_array(auth()->user()->type, ['guard']))
                        <li>
                            <a href="/historico" class="dropdown-item btn btn-secondary text-start w-100 mt-1">
                                <i class="bi bi-basket3 me-2"></i> Histórico
                            </a>
                        </li>

                        <li>
                            <a href="/painelStudents" class="dropdown-item btn btn-secondary text-start w-100 mt-1">
                                <i class="bi bi-people me-2"></i> Alunos
                            </a>
                        </li>
                    @endif

                    @if (in_array(auth()->user()->type, ['admin', 'func', 'guard', 'student']))
                        <li>
                            <a href="/profile" class="dropdown-item btn btn-secondary text-start w-100 mt-1">
                                <i class="bi bi-person me-2"></i> Perfil
                            </a>
                        </li>
                    @endif

                    @if (in_array(auth()->user()->type, ['admin', 'guard']))
                        <li>
                            <a href="/recarga" class="dropdown-item btn btn-secondary text-start w-100 mt-1">
                                <i class="bi bi-wallet me-2"></i> Recarga
                            </a>
                        </li>
                    @endif

                    @if (in_array(auth()->user()->type, ['guard', 'student']))
                        <li>
                            <a href="/agendamento" class="dropdown-item btn btn-secondary text-start w-100 mt-1">
                                <i class="bi bi-calendar-event me-2"></i> Agendamento
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/recargaCliente" class="nav-link text-white btn btn-secondary text-start">
                                <i class="bi bi-wallet fs-5 me-2"></i> Recarga
                            </a>
                        </li>
                    @endif

                    @if (auth()->user()->type === 'student')
                        <li>
                            <a href="/historico" class="dropdown-item btn btn-secondary text-start w-100 mt-1">
                                <i class="bi bi-basket3 me-2"></i> Histórico
                            </a>
                        </li>
                    @endif

                    <hr class="my-2 text-secondary">

                    <li>
                        <form id="logout-form" action="{{ route('login.logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        <a class="dropdown-item btn btn-danger text-start w-100" href="#"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i> Sair
                        </a>
                    </li>
                </ul>
            </div>

            <a href="{{ route('home') }}" class="text-white text-decoration-none fs-4 fw-bold"><img
                    src="{{ asset('images/AlphaLanches-Logo.png') }}" height="78px" alt="Logo Alpha"></a>
        </div>
    </nav>
</div>