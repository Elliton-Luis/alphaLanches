<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AlphaLanches - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">

    <div class="card p-4 shadow" style="width: 350px;">
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{ asset('images/AlphaLanches-Logo.png') }}" width="50%" alt="Logo Alpha">
        </div>

        <h3 class="text-center mb-3">Login</h3>

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

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif


        <form action="{{ route('login.auth') }}" method="POST">
            @csrf
        <div class="mb-3 position-relative">
            <i class="bi bi-envelope-fill position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i>
            <input type="email" class="form-control form-control-lg ps-5" name="email" placeholder="Digite seu e-mail" required>
        </div>

        <div class="mb-3 position-relative">
            <i class="bi bi-lock-fill position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i>
            <input type="password" class="form-control form-control-lg ps-5 pe-5" name="password" id="password" placeholder="Digite sua senha" required>
            <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 text-secondary" id="togglePassword" style="cursor: pointer;"></i>
            <script>
                const toggle = document.getElementById('togglePassword');
                const input = document.getElementById('password');

                toggle.addEventListener('click', function () {
                    input.type = input.type === 'password' ? 'text' : 'password';
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            </script>
        </div>

            
            <button type="submit" class="btn btn-primary w-100">Entrar</button>
        </form>
        <div class="text-center mt-3">
            <a href="{{route('esqueciSenha.index')}}">Esqueceu a senha?</a>
        </div>
        <div class="text-center mt-3">
            <a href="{{route('login.cadastro')}}">Cadastre-se</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>