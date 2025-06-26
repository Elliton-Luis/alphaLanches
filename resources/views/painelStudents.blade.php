@extends('layouts.default')

@section('title', 'AlphaLanches - Alunos')

@section('content')
    <h2 class="text-center mb-5">Gerenciamento de Alunos</h2>

    <div class="d-block d-md-flex justify-content-around">
        <!--<livewire:table-a-ccounts-admin/>-->
        <livewire:form-create-student/>
    </div>
@endsection