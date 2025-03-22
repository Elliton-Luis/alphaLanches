@extends('layouts.default')

@section('title', 'AlphaLanches - Financeiro')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/financeiro.css') }}">
    <script src="{{ asset('js/financeiro.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div class="container mt-4 text">
        <h1 class="text-center mb-4">Painel Financeiro</h1>

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

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Ranking de Produtos Mais Vendidos</h5>
                <ul class="list-group">
                    <li class="list-group-item">Sanduíche - 150 vendas</li>
                    <li class="list-group-item">Refrigerante - 120 vendas</li>
                    <li class="list-group-item">Salgado - 100 vendas</li>
                </ul>
            </div>
        </div>
    </div>
@endsection