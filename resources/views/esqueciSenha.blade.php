<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AlphaLanches - Esqueci Senha</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body class="d-flex justify-content-center align-items-center vh-100 bg-light">
    <div class="card p-4 shadow" style="width: 350px;">
        <div class="d-flex justify-content-center align-items-center">
            <img src="{{ asset('images/AlphaLanches-Logo.png') }}" width="50%" alt="Logo Alpha">
        </div>

        <h3 class="text-center mb-3">Redefinir Senha</h3>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <p class="text-center mb-3 border border-primary rounded p-2">
            Digite seu email para que seja enviado um código de recuperação de senha
        </p>

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3 position-relative">
                <i
                    class="bi bi-envelope-fill position-absolute top-50 start-0 translate-middle-y ms-3 text-secondary"></i>
                <input type="email" class="form-control form-control-lg ps-5" name="email"
                    placeholder="Digite seu e-mail" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Enviar link de redefinição</button>
        </form>
    </div>
</body>

</html>