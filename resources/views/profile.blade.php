@extends('layouts.default')

@section('title', 'AlphaLanches - Perfil')

@section('content')
<div class="container">
    <h2 class="mb-4">Meu Perfil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="profile_picture" class="form-label">Foto de Perfil</label>
            <input type="file" class="form-control" id="profile_picture" name="profile_picture">
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" class="mt-2" width="100" alt="Foto de Perfil">
                <br>
                <a href="{{ route('profile.remove_picture') }}" class="btn btn-danger btn-sm mt-2">Remover Foto</a>
            @endif
        </div>

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
            <label for="phone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
            @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf', $user->cpf) }}">
            @error('cpf') <small class="text-danger">{{ $message }}</small> @enderror
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

    <hr>
    <form method="POST" action="{{ route('profile.delete') }}" onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger mt-3">Excluir Conta</button>
    </form>
</div>
@endsection