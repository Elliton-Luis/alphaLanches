@extends('layouts.default')

@section('title', 'AlphaLanches - Perfil')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/perfil.css') }}">
    <script src="{{ asset('js/perfil.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <div class="container mt-4">
        <h2 class="mb-5 text-center">Meu Perfil</h2>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf

            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="row gy-4">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="text" class="form-control" id="name" name="name" maxlength="100"
                                    value="{{ old('name', $user->name) }}" required>
                                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14"
                                    value="{{ old('cpf', $user->cpf) }}">
                                <script>
                                    jQuery(function ($) {
                                        $("#cpf").mask("999.999.999-99");
                                    });
                                </script>
                                @error('cpf') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" maxlength="254"
                                    value="{{ old('email', $user->email) }}" required>
                                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone"
                                    value="{{ old('telefone', $user->telefone) }}" maxlength="15">
                                <script>
                                    jQuery(function ($) {
                                        $("#telefone").mask("(99) 99999-9999");
                                    });
                                </script>
                                @error('telefone') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Nova Senha (opcional)</label>
                                <input type="password" class="form-control" id="password" name="password" maxlength="27">
                                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" maxlength="27">
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary me-2">Salvar Alterações</button>
                    </div>
                </div>
            </div>
        </form>

        <div class="text-center mt-3">
            <form method="POST" action="{{ route('profile.delete') }}"
                onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Excluir Conta</button>
            </form>
        </div>
    </div>
@endsection