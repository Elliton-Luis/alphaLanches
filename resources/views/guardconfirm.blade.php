@extends('layouts.default')
@section('title','GuardConfirm')
@section('content')

<div class="container mt-4">
    <h2 class="text-center mb-5 fw-bold">
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
                                <div class="d-flex justify-content-center flex-wrap gap-2">
                                    <a class="btn btn-success btn-sm" href="{{route('guardRequests.accept', ['id'=>$request->id])}}">Aceitar</a>
                                    <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modal1{{$loop->index}}">Rejeitar</button>
                                    <div class="modal fade" id="modal1{{$loop->index}}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5">Rejeitar {{$request->name}}</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{route('guardRequests.reject', ['id'=>$request->id])}}">
                                                        @csrf
                                                        <div>
                                                            <label for="" class="form-label">Motivo da Rejeição</label>
                                                            <textarea name="MRejeitar" class="form-control" id="" cols="30" rows="5"></textarea>
                                                        </div>
                                                        <div class="d-flex justify-content-end mt-2">
                                                            <button type="submit" class="btn btn-danger">Rejeitar Pedido</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">Nenhum pedido encontrado</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
