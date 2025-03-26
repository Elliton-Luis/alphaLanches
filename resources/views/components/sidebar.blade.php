<div id="sidebar" class="collapse d-none d-md-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 240px;">
    <div id="image" style="margin-left: 15%">
        <a href="{{ url('home') }}" class="d-flex align-items-center" style="width: 100px">
            <img src="{{ asset('images/AlphaLanches-Logo.png') }}" height=78px" alt="Logo Alpha">
        </a>
    </div>
    
    <hr>
    
    <ul class="nav nav-pills flex-column mb-auto">
        @php
            $buttons = [ #Falta adicionar as rotas
                ['route' => 'home', 'icon' => 'house-door-fill', 'label' => 'Painel Inicial'],
                ['route' => 'home', 'icon' => 'person-fill-add', 'label' => 'Cadastrar Usuário'], #ERRADO
                ['route' => 'financeiro', 'icon' => 'currency-dollar', 'label' => 'Financeiro'],
                ['route' => 'estoque', 'icon' => 'box', 'label' => 'Estoque'],
                ['route' => 'profile', 'icon' => 'person-circle', 'label' => 'Perfil'],
                ['route' => 'home', 'icon' => 'people-fill', 'label' => 'Usuários'], #ERRADO
                ['route' => 'home', 'icon' => 'basket', 'label' => 'Histórico de Compras'], #ERRADO
                ['route' => 'home', 'icon' => 'shop', 'label' => 'PDV'], #ERRADO
                ['route' => 'home', 'icon' => 'info-circle', 'label' => 'Sobre Nós'], #ERRADO
            ];
        @endphp

        @foreach ($buttons as $btn)
            <li class="nav-item">
                <a href="{{ url($btn['route'])}}" class="nav-link text-white btn btn-primary text-start">
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
            <li><a class="dropdown-item" href="#">Configurações</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Sair</a></li>
        </ul>
    </div>
</div>
