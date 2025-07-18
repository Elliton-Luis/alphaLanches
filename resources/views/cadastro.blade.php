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

        @media (max-width: 576px) {
            .card {
                margin: 0 1rem;
            }
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Cadastro de Responsável</h3>

        @if(Session::has('errorAuth'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('errorAuth') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <form action="{{ route('login.store') }}" method="POST">
            @csrf

            <div class="mb-3 form-group">
                <i class="fas fa-user icon"></i>
                <input type="text" class="form-control form-control-lg form-control-icon" name="name" placeholder="Digite seu nome*" required maxlength="100">
            </div>

            <div class="mb-3 form-group">
                <i class="fas fa-envelope icon"></i>
                <input type="email" class="form-control form-control-lg form-control-icon" name="email" placeholder="Digite seu e-mail*" required maxlength="254">
            </div>

            <div class="mb-3 form-group">
                <i class="fas fa-phone-alt icon"></i>
                <input type="text" class="form-control form-control-lg form-control-icon" id="telefone" name="telefone" placeholder="Digite seu telefone" />
                <script>
                jQuery(function ($) {
                    $("#telefone").mask("(99) 99999-9999");
                });
                </script>
            </div>

            <div class="mb-3 form-group">
                <i class="fas fa-id-card icon"></i>
                <input type="text" class="form-control form-control-lg form-control-icon" id="cpf" name="cpf" placeholder="Digite seu CPF" />
                <script>
                jQuery(function ($) {
                    $("#cpf").mask("999.999.999-99");
                });
                </script>
            </div>

            <div class="mb-3">
                <input type="checkbox" name="confirmacao" id="confirmacao" value="1" class="form-check-input" required>
                <label for="confirmacao" class="form-check-label">Confirmo que sou responsável pelo cadastro</label>
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
