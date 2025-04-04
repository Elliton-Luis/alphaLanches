@extends('layouts.default')

@section('title', 'AlphaLanches - Financeiro')

@section('content')
    <script src="{{ asset('js/financeiro.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container mt-4 text">
        <h1 class="text-center mb-4">Painel Financeiro</h1>

        <br>

        <div class="row justify-content-evenly align-items-center flex-wrap">
            <div class="col-md-3">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Saldo Atual</h5>
                        <p class="card-text">R$ 5.240,00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Receita Atual</h5>
                        <p class="card-text">R$ 42.500,00</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Despesa Atual</h5>
                        <p class="card-text">R$ 26.000,00</p>
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
                        <p class="card-text">R$ 850,00</p>
                    </div>
                </div>
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Vendas do Mês</h5>
                        <p class="card-text">R$ 15.320,00</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Últimas Transações</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Cliente</th>
                            <th>Produto</th>
                            <th>Valor</th>
                            <th>Data</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>João Silva</td>
                            <td>Sanduíche</td>
                            <td>R$ 12,00</td>
                            <td>20/03/2025</td>
                        </tr>
                        <tr>
                            <td>Maria Souza</td>
                            <td>Suco Natural</td>
                            <td>R$ 8,00</td>
                            <td>20/03/2025</td>
                        </tr>
                        <tr>
                            <td>Carlos Lima</td>
                            <td>Salgado</td>
                            <td>R$ 6,50</td>
                            <td>20/03/2025</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card shadow-lg border-0 mb-4">
            <div class="card-body">
                <h5 class="card-title text-center fw-bold mb-3">
                    <i class="fas fa-trophy text-warning"></i> Ranking de Produtos Mais Vendidos
                </h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between fw-bold">
                            <span>🥇 Sanduíche</span>
                            <span class="badge bg-success rounded-pill">150 vendas</span>
                        </div>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 42%" 
                                 aria-valuenow="42" aria-valuemin="0" aria-valuemax="100">
                                42%
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between fw-bold">
                            <span>🥈 Refrigerante</span>
                            <span class="badge bg-primary rounded-pill">120 vendas</span>
                        </div>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 33%" 
                                 aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
                                33%
                            </div>
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between fw-bold">
                            <span>🥉 Salgado</span>
                            <span class="badge bg-secondary rounded-pill">100 vendas</span>
                        </div>
                        <div class="progress mt-2">
                            <div class="progress-bar bg-secondary" role="progressbar" style="width: 28%" 
                                 aria-valuenow="28" aria-valuemin="0" aria-valuemax="100">
                                28%
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection