@extends('layouts.default')

@section('title', 'AlphaLanches - Perfil')

@section('content')
<div class="container">
    <h2 class="mb-4">Meu Perfil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('perfil.update') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Nova Senha (opcional)</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Senha</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
</div>
@endsection