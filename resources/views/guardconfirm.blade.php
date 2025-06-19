@extends('layouts.default')
@section('title','AlphaLanches - Responsáveis')

@section('content')

<div class="container my-5">
    <h2 class="text-center fw-bold mb-4">📋 Pedidos de Responsáveis</h2>

    @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-3" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover align-middle rounded-3 overflow-hidden">
            <thead class="table-light">
                <tr class="text-center">
                    <th>Nome</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                @if ($requests->count() > 0)
                    @foreach ($requests as $request)
                        <tr class="text-center">
                            <td class="fw-semibold">{{ $request->name }}</td>
                            <td>{{ $request->email }}</td>
                            <td>{{ $request->cpf }}</td>
                            <td>{{ $request->telefone }}</td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-outline-success btn-sm rounded-pill px-3" 
                                       href="{{ route('guardRequests.accept', ['id'=>$request->id]) }}">
                                       ✔️ Aceitar
                                    </a>
                                    <button class="btn btn-outline-danger btn-sm rounded-pill px-3" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modal1{{ $loop->index }}">
                                        ❌ Rejeitar
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="modal1{{ $loop->index }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content rounded-4 border-0 shadow-sm">
                                                <div class="modal-header border-0">
                                                    <h5 class="modal-title">Rejeitar {{ $request->name }}</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="POST" action="{{ route('guardRequests.reject', ['id'=>$request->id]) }}">
                                                        @csrf
                                                        <div class="mb-3">
                                                            <label class="form-label">Motivo da Rejeição</label>
                                                            <textarea name="MRejeitar" class="form-control rounded-3" rows="4"></textarea>
                                                        </div>
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-danger rounded-pill px-4">Confirmar Rejeição</button>
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
                        <td colspan="5" class="text-center py-4 text-muted">Nenhum pedido encontrado</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

@endsection
