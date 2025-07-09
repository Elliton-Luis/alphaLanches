@extends('layouts.default')
@section('title', 'AlphaLanches - Historico')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>{{ Auth::user()->isAdmin() ? 'Histórico de Recargas' : 'Meu Histórico de Recargas' }}</h4>
                    </div>

                    <div class="card-body">
                        <form method="GET" action="{{ route('historico.index') }}" class="mb-4">
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
                        @if($vendas->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Data</th>
                                            @if(Auth::user()->isAdmin())
                                                <th>Cliente</th>
                                            @endif
                                            <th>Itens</th>
                                            <th>Valor Total</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($vendas as $venda)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($venda->saleDate)->format('d/m/Y') }}</td>
                                                @if(Auth::user()->isAdmin())
                                                    <td>{{ $venda->user->name }}</td>
                                                @endif
                                                <td>
                                                    <small>
                                                        @foreach($venda->saleProducts as $item)
                                                            {{ $item->productQuantity }}x {{ $item->product->name }}
                                                            @if(!$loop->last), @endif
                                                        @endforeach
                                                    </small>
                                                </td>
                                                <td>
                                                    <strong>R$ {{ number_format($venda->value, 2, ',', '.') }}</strong>
                                                </td>
                                                <td>
                                                    <a href="{{ route('historico.show', $venda->id) }}" class="btn btn-sm btn-info">
                                                        <i class="fas fa-eye"></i> Ver
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Paginação -->
                            <div class="d-flex justify-content-center">
                                {{ $vendas->appends(request()->query())->links() }}
                            </div>
                        @else
                            <div class="alert alert-info text-center">
                                <i class="fas fa-info-circle"></i>
                                {{ Auth::user()->isAdmin() ? 'Nenhuma venda encontrada.' : 'Você ainda não fez nenhuma compra.' }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection