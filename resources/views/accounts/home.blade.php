@extends('layouts.default')

@section('title', 'Criar Login - Alpha')

@section('content')
    <h1 class="text-center"><i class="bi bi-person-lines-fill"></i> Gerenciamento de contas</h1>

    <div class="d-block d-md-flex justify-content-around">
        <livewire:table-a-ccounts-admin/>
        <livewire:form-create-account/>
    </div>
@endsection

