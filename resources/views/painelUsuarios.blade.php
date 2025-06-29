@extends('layouts.default')

@section('title', 'AlphaLanches - Usuários')

@section('content')
    <h2 class="text-center mb-5">Gerenciamento de contas</h2>

    <div class="d-block d-md-flex justify-content-around gap-3">
        <div style="flex: 0 0 60%; max-width: 60%;">
            <livewire:table-a-ccounts-admin />
        </div>
        <div style="flex: 0 0 35%; max-width: 35%;">
            <livewire:form-create-account />
        </div>
    </div>
@endsection
