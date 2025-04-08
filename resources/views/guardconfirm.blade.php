@extends('layouts.default')
@section('title','GuardConfirm')
@section('content')

<div class="container">
    <h2 class="text-center mb-5">
        Pedidos de Responsáveis
    </h2>
    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    <div class="table-responsive">
        <table class="table table-bordered border-dark">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Ação</th>
                </tr>
            </thead>
            <tbody>
                @if ($requests->count() > 0)
                    @foreach ($requests as $request)
                        <tr class="text-center">
                            <td>{{$request->name}}</td>
                            <td>{{$request->email}}</td>
                            <td>{{$request->cpf}}</td>
                            <td>{{$request->telefone}}</td>
                            <td>
                                <div class="d-flex justify-content-center p-1 gap-2">
                                    <a class="btn btn-success btn-sm" href="{{route('guardRequests.accept', ['id'=>$request->id])}}">Aceitar</a>
                                    <button class="btn btn-danger btn-sm">Rejeitar</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <h2 class="text-center">Nenhum pedido encontrado</h2>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection

