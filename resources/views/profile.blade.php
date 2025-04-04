@extends('layouts.default')

@section('title', 'AlphaLanches - Perfil')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <script src="{{ asset('js/perfil.js') }}"></script>

    <div class="container">
        <h2 class="mb-4">Meu Perfil</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-4 text-center">
                    <label for="profile_picture" class="d-inline-block position-relative profile-container">
                        <img id="profilePreview"
                            src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/photo_user_generic.png') }}"
                            class="rounded-circle border profile-image" width="240" height="240" alt="Foto de Perfil">
                        <div class="profile-overlay">
                            <i class="bi bi-camera profile-icon"></i>
                        </div>
                        <input type="file" class="d-none" id="profile_picture" name="profile_picture" accept="image/*"
                            onchange="previewImage(event)">
                    </label>
                </div>
                                
                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}"
                            required>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" value="{{ old('cpf', $user->cpf) }}"
                            oninput="mascaraCpf(event)" maxlength="14">
                        @error('cpf') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ old('email', $user->email) }}" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control" id="telefone" name="telefone"
                            value="{{ old('telefone', $user->telefone) }}" oninput="mascaraTelefone(event)" maxlength="15">
                        @error('telefone') <small class="text-danger">{{ $message }}</small> @enderror
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
                </div>
            </div>

            <div class="text-left mt-3">
                <button type="submit" class="btn btn-primary me-2">Salvar Alterações</button>
            </div>
        </form>

        <div class="text-left mt-3">
            @if($user->profile_picture)
                <form action="{{ route('profile.removePicture') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-secondary">Remover Foto</button>
                </form>
            @endif
        </div>

        <div class="text-left mt-3">
            <form method="POST" action="{{ route('profile.delete') }}"
                onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Excluir Conta</button>
            </form>
        </div>
    </div>
@endsection