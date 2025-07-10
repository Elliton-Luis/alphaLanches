@extends('layouts.default')

@section('title', 'AlphaLanches - Login')

@section('content')
    <body class="d-flex justify-content-center align-items-center vh-100 bg-light">

        <div class="container">
            <h2>Digite sua nova senha</h2>
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <label>Email:</label>
                <input type="email" name="email" required>
                <label>Nova Senha:</label>
                <input type="password" name="password" required>
                <label>Confirme a Senha:</label>
                <input type="password" name="password_confirmation" required>
                <button type="submit">Redefinir Senha</button>
            </form>
        </div>
    </body>
@endsection