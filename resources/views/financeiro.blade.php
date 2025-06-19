@extends('layouts.default')

@section('title', 'AlphaLanches - Financeiro')

@section('content')
  <div class="container my-5">
    <h2 class="text-center fw-bold mb-4 display-6">📊 Painel Financeiro</h2>

    <div class="row g-4">
    <div class="col-12 col-md-4 d-flex flex-column gap-3">
      <div class="card border-0 shadow-lg text-white bg-success rounded-4">
      <div class="card-body text-center py-4">
        <h3 class="fw-light text-uppercase mb-2">Receita Atual</h3>
        <h3 class="fw-bold mb-0">R$ {{ number_format($totalSalesValue, 2, ',', '.') }}</h3>
      </div>
      </div>

      <div class="card border-0 shadow-lg text-white bg-primary rounded-4">
      <div class="card-body text-center py-4">
        <h3 class="fw-light text-uppercase mb-2">Vendas do Dia</h3>
        <h4 class="fw-bold mb-1">{{ $dailySales }} vendas</h4>
        <p class="mb-0 fs-5">R$ {{ number_format($totalDailyValue, 2, ',', '.') }}</p>
      </div>
      </div>

      <div class="card border-0 shadow-lg text-white bg-dark rounded-4">
      <div class="card-body text-center py-4">
        <h3 class="fw-light text-uppercase mb-2">Vendas do Mês</h3>
        <h4 class="fw-bold mb-1">{{ $monthlySales }} vendas</h4>
        <p class="mb-0 fs-5">R$ {{ number_format($totalMonthlyValue, 2, ',', '.') }}</p>
      </div>
      </div>
    </div>

    <div class="col-12 col-md-8">
      <div class="card border-0 shadow-lg rounded-4 h-100">
      <div class="card-body p-4">
        <h5 class="fw-bold mb-4">📈 Receita dos Últimos Meses</h5>
        <canvas id="graficoReceitasDespesas" height="200"></canvas>
      </div>
      </div>
    </div>
    </div>

    <div class="card shadow-sm border-0 my-4">
    <div class="card-body">
      <h5 class="fw-bold text-center mb-3">
      <i class="fas fa-trophy text-warning"></i> Produtos Mais Vendidos
      </h5>
      <ul class="list-group list-group-flush">
      @foreach($ranking as $item)
      <li class="list-group-item">
      <div class="d-flex justify-content-between align-items-center">
      <span class="fw-semibold">
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
      <span class="badge bg-success rounded-pill">{{ $item['quantity'] }} vendas</span>
      </div>
      <div class="progress mt-2">
      <div class="progress-bar bg-success" role="progressbar" style="width: {{ $item['percentage'] ?? 0 }}%"
        aria-valuenow="{{ $item['percentage'] ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
        {{ $item['percentage'] ?? 0 }}%
      </div>
      </div>
      </li>
    @endforeach
      </ul>
    </div>
    </div>

    <div class="col-12 mx-auto">
    <div class="card">
      <div class="card-body">
      <h5 class="card-title text-center">Últimas Transações</h5>
      <div class="table-responsive" style="max-height: 280px; overflow-y: auto;">
        <table class="table table-striped">
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
        <td>R$ {{ number_format($saleProduct->productQuantity * $saleProduct->product->price, 2, ',', '.') }}
        </td>
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

  </div>

  <!-- Scripts -->
  <script>
    window.vendasMesesLabels = @json($months);
    window.vendasMesesData = @json($revenues);
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="{{ asset('js/financeiro.js') }}"></script>
@endsection