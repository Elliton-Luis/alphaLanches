<div id="sidebar" class="collapse d-none d-md-flex flex-column flex-shrink-0 p-3 text-bg-dark" style="width: 200px;">
    <a href="{{ route('home.index') }}" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
        <img src="{{ asset('images/logo_black.png') }}" height="30px" alt="Logo Alpha">
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item">
            <a href="{{ route('create.user.index') }}" class="nav-link text-white btn btn-primary text-start">
                <i class="bi bi-person-fill-add fs-5"></i> Criar Login
            </a>
        </li>
    </ul>
    <hr>
    <div class="dropdown">
        <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
            data-bs-toggle="dropdown" aria-expanded="false">
            <strong>name || {{ auth()->user()->type }}</strong>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
            <li><a class="dropdown-item" href="}">Alterar dados</a></li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="{{ route('login.logout') }}">Sair</a></li>
        </ul>
    </div>
</div>
