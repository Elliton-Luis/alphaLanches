@extends('layouts.default')
@section('title', 'AlphaLanches - Historico')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Histórico de Recargas</h4>
                    </div>

                    <div class="card-body">
                        <form method="GET" action="{{ route('historicoRecarga.index') }}" class="mb-4">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="data_inicio">Data Início</label>
                                    <input type="date" name="data_inicio" id="data_inicio" class="form-control"
                                        value="{{ request('data_inicio') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="data_fim">Data Fim</label>
                                    <input type="date" name="data_fim" id="data_fim" class="form-control"
                                        value="{{ request('data_fim') }}">
                                </div>
                                <div class="col-md-3">
                                    <label for="users">Usuário</label>
                                    <input type="text" name="users" id="users" class="form-control"
                                        placeholder="Digite o nome..." value="{{ request('users') }}">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> Filtrar
                                    </button>
                                    <a href="{{ route('historico.index') }}" class="btn btn-secondary">
                                        <i class="fas fa-times"></i> Limpar
                                    </a>
                                </div>
                            </div>
                        </form>

                        <!-- Tabela de vendas -->
                        @if($logs->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            <th>Cliente</th>
                                            <th>Executado por</th>
                                            <th>Tipo</th>
                                            <th>Valor</th>
                                            <th>Método de Pagamento</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($logs as $log)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($log->created_at)->format('d/m/Y H:i') }}</td>

                                                <td>{{ $log->user?->name ?? '-' }}</td>
                                                <td>{{ $log->executor?->name ?? '-' }}</td>

                                                <td>
                                                    <span class="badge {{ $log->tipo === 'entrada' ? 'bg-success' : 'bg-danger' }}">
                                                        {{ ucfirst($log->tipo) }}
                                                    </span>
                                                </td>

                                                <td>
                                                    <strong>R$ {{ number_format($log->valor, 2, ',', '.') }}</strong>
                                                </td>

                                                <td>{{ $log->metodo_pagamento ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Paginação -->
                            <div class="d-flex justify-content-center">
                                {{ $logs->appends(request()->query())->links() }}
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                <i class="fas fa-info-circle"></i>
                                Nenhum registro de crédito encontrado.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection