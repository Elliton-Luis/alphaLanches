@extends('layouts.default')

@section('title', 'Criar Login - Alpha')

@section('content')
    <h2 class="text-center mb-5">Gerenciamento de contas</h2>

        <div class="row g-4">
            <div class="col-12 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Lista de Contas</h5>
                    </div>
                    <div class="card-body">
                        <livewire:table-a-ccounts-admin/>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Criar Nova Conta</h5>
                    </div>
                    <div class="card-body">
                        <livewire:form-create-account/>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
