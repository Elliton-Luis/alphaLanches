<div id="sidebar" class="collapse d-none d-md-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 200px;">
    <a href="#" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="{{ asset('images/logo_black.png') }}" height="30px" alt="Logo Alpha">
    </a>
    <hr>
    
    <ul class="nav nav-pills flex-column mb-auto">
        @php
            $buttons = [
                ['icon' => 'house-door-fill', 'label' => 'Painel Inicial'],
                ['icon' => 'person-fill-add', 'label' => 'Cadastrar Usuário'],
                ['icon' => 'currency-dollar', 'label' => 'Financeiro'],
                ['icon' => 'box', 'label' => 'Estoque'],
                ['icon' => 'person-circle', 'label' => 'Perfil'],
                ['icon' => 'people-fill', 'label' => 'Usuários'],
                ['icon' => 'basket', 'label' => 'Histórico de Compras'],
                ['icon' => 'shop', 'label' => 'PDV'],
                ['icon' => 'info-circle', 'label' => 'Sobre Nós'],
            ];
        @endphp

        @foreach ($buttons as $btn)
            <li class="nav-item">
                <a href="#" class="nav-link text-white btn btn-primary text-start">
                    <i class="bi bi-{{ $btn['icon'] }} fs-5 me-2"></i> {{ $btn['label'] }}
                </a>
            </li>
        @endforeach
    </ul>

    <hr>

    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
           data-bs-toggle="dropdown" aria-expanded="false">
            <strong>{{ auth()->user()->name ?? 'Usuário' }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="#">Alterar dados</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sair</a></li>
        </ul>
    </div>
</div>
