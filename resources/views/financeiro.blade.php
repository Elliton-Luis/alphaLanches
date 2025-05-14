@extends('layouts.default')

@section('title', 'AlphaLanches - Financeiro')

@section('content')
    <div class="container mt-4 text">
        <h2 class="text-center mb-5">Painel Financeiro</h2>
        <div class="row g-4">
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Receita Atual</h5>
                        <p class="card-text">R$ {{ number_format($totalSalesValue, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Receitas e Despesas</h5>
                        <canvas id="graficoReceitasDespesas"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Vendas do Dia</h5>
                        <p class="card-text">Vendas {{ $dailySales }}</p>
                        <p class="card-text">R$ {{ number_format($totalDailyValue, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-lg-3">   
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Vendas do Mês</h5>
                        <p class="card-text">Vendas {{ $monthlySales }}</p>
                        <p class="card-text">R$ {{ number_format($totalMonthlyValue, 2, ',', '.') }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row g-4 mt-4">
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Receita</h5>
                        <canvas id="graficoReceitasDespesas"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Últimas Transações</h5>
                        <div class="table-responsive" style="max-height: 280px; overflow-y: auto;">
                            <table class="table table-striped" >
                                <thead>
                                    <tr>
                                        <th>Cliente</th>
                                        <th>Produto</th>
                                        <th>Quantidade</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sales as $sale)
                                        @foreach($sale->saleProducts as $saleProduct)
                                            <tr>
                                                <td>{{ $sale->user->name }}</td>
                                                <td>{{ $saleProduct->product->name }}</td>
                                                <td>{{ $saleProduct->productQuantity }}</td>
                                                <td>R$ {{ number_format($saleProduct->productQuantity * $saleProduct->product->price, 2, ',', '.') }}</td>
                                                <td>{{ \Carbon\Carbon::parse($sale->saleDate)->format('d/m/Y') }}</td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-body">
                <h5 class="card-title text-center fw-bold mb-3">
                    <i class="fas fa-trophy text-warning"></i> Ranking de Produtos Mais Vendidos
                </h5>
                <ul class="list-group list-group-flush">
                    @foreach($ranking as $item)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center fw-bold">
                                <span>
                                    @if($loop->iteration == 1)
                                        <i class="fas fa-medal text-warning"></i>
                                    @elseif($loop->iteration == 2)
                                        <i class="fas fa-medal text-secondary"></i>
                                    @elseif($loop->iteration == 3)
                                        <i class="fas fa-medal text-dark"></i>
                                    @else
                                        <i class="fas fa-star text-muted"></i>
                                    @endif
                                    {{ $item['name'] }}
                                </span>
                                <span class="badge bg-success rounded-pill">
                                    {{ $item['quantity'] }} vendas
                                </span>
                            </div>
                            <div class="progress mt-2">
                                <div class="progress-bar bg-success" role="progressbar" 
                                    style="width: {{ $item['percentage'] ?? 0 }}%" 
                                    aria-valuenow="{{ $item['percentage'] ?? 0 }}"" 
                                    aria-valuemin="0" aria-valuemax="100">
                                    {{ $item['percentage'] }}%
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

    <script>
        window.vendasMesesLabels = @json($months);
        window.vendasMesesData = @json($revenues);
    </script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/financeiro.js') }}"></script>
@endsection