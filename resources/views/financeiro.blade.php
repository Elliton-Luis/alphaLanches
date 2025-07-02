@extends('layouts.default')

@section('title', 'AlphaLanches - Financeiro')

@section('content')
<div class="container my-5">
  <h2 class="text-center fw-bold mb-4 display-6">📊 Painel Financeiro</h2>

  <div class="row g-4">
    <div class="col-12 col-md-4 d-flex flex-column gap-3">

      <!-- Receita Atual -->
      <div class="card border-0 shadow-lg text-white bg-success rounded-4">
        <div class="card-body text-center py-4">
          <h3 class="fw-light text-uppercase mb-2">Receita Atual</h3>
          <h3 class="fw-bold mb-0">R$ {{ number_format($totalSalesValue, 2, ',', '.') }}</h3>
        </div>
      </div>

      <!-- Vendas do Dia -->
      <div class="card border-0 shadow-lg text-white bg-primary rounded-4">
        <div class="card-body text-center py-4">
          <h3 class="fw-light text-uppercase mb-2">Vendas do Dia</h3>
          <h4 class="fw-bold mb-1">{{ $dailySales }} vendas</h4>
          <p class="mb-0 fs-5">R$ {{ number_format($totalDailyValue, 2, ',', '.') }}</p>
        </div>
      </div>

      <!-- Vendas do Mês -->
      <div class="card border-0 shadow-lg text-white bg-dark rounded-4">
        <div class="card-body text-center py-4">
          <h3 class="fw-light text-uppercase mb-2">Vendas do Mês</h3>
          <h4 class="fw-bold mb-1">{{ $monthlySales }} vendas</h4>
          <p class="mb-0 fs-5">R$ {{ number_format($totalMonthlyValue, 2, ',', '.') }}</p>
        </div>
      </div>

      <!-- ✅ Novo Card: Itens Vendidos -->
      <div class="card border-0 shadow-lg text-white bg-warning rounded-4">
        <div class="card-body text-center py-4">
          <h3 class="fw-light text-uppercase mb-2">Itens Vendidos</h3>
          <h3 class="fw-bold mb-0">{{ $totalItemsSold }}R$</h3>
        </div>
      </div>

    </div>

    <!-- Gráfico Receita dos Últimos Meses -->
    <div class="col-12 col-md-8">
      <div class="card border-0 shadow-lg rounded-4 h-100">
        <div class="card-body p-4">
          <h5 class="fw-bold mb-4">📈 Receita dos Últimos Meses</h5>
          <canvas id="graficoReceitasDespesas" height="200"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Ranking de Produtos -->
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
            <div class="progress-bar bg-success" role="progressbar"
                 style="width: {{ $item['percentage'] ?? 0 }}%"
                 aria-valuenow="{{ $item['percentage'] ?? 0 }}"
                 aria-valuemin="0" aria-valuemax="100">
              {{ $item['percentage'] ?? 0 }}%
            </div>
          </div>
        </li>
        @endforeach
      </ul>
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
