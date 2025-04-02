<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AlphaLanches - Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        .form-control-icon {
            padding-left: 2.5rem;
        }

        .form-group {
            position: relative;
        }

        .form-group i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
        }

        .card {
            max-width: 400px;
            width: 100%;
        }

        .card-body {
            background-color: #f7f7f7;
        }

        .btn-custom {
            background-color: #4e73df;
            color: white;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            background-color: #2e59d9;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <script src="{{ asset('js/perfil.js') }}"></script>

    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Cadastro de Usuário</h3>

        @if(Session::has('errorAuth'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('errorAuth') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(Session::has('successLogout'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('successLogout') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST">
            @csrf

            <div class="mb-3 form-group">
                <i class="fas fa-user icon"></i>
                <input type="text" class="form-control form-control-lg form-control-icon" name="name" placeholder="Digite seu nome*" required>
            </div>

            <div class="mb-3 form-group">
                <i class="fas fa-envelope icon"></i>
                <input type="email" class="form-control form-control-lg form-control-icon" name="email" placeholder="Digite seu e-mail*" required>
            </div>

            <div class="mb-3 form-group">
                <i class="fas fa-phone-alt icon"></i>
                <input type="text" class="form-control form-control-lg form-control-icon" name="telefone" placeholder="Digite seu telefone" oninput="mascaraTelefone(event)" maxlength="15"/>
            </div>

            <div class="mb-3 form-group">
                <i class="fas fa-id-card icon"></i>
                <input type="text" class="form-control form-control-lg form-control-icon" name="cpf" placeholder="Digite seu CPF" oninput="mascaraCpf(event)" maxlength="14" />
            </div>

            <div class="mb-3 form-group">
                <i class="fas fa-lock icon"></i>
                <input type="password" class="form-control form-control-lg form-control-icon" name="password" placeholder="Digite sua senha*" required>
            </div>

            <div class="mb-3 form-group">
                <i class="fas fa-lock icon"></i>
                <input type="password" class="form-control form-control-lg form-control-icon" name="confirmPassword" placeholder="Confirme sua senha*" required>
            </div>

            <button type="submit" class="btn btn-custom text-light w-100">Cadastrar</button>
        </form>

        <div class="text-center mt-3">
            <a href="{{ route('login') }}" class="text-decoration-none">Já possui uma conta? Faça login</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
