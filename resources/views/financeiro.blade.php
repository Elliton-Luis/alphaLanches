@extends('layouts.default')

@section('title', 'AlphaLanches - Financeiro')

@section('content')
<div class="container my-5">
  <h2 class="text-center fw-bold mb-4">Painel Financeiro</h2>

  <div class="row g-3">
    <div class="col-12 col-md-4 d-flex flex-column gap-2">
      <div class="card border-0 shadow-sm text-white bg-success">
        <div class="card-body text-center py-2">
          <h6 class="fw-semibold mb-0 small">Receita Atual</h6>
          <h5 class="mb-0">R$ {{ number_format($totalSalesValue, 2, ',', '.') }}</h5>
        </div>
      </div>

      <div class="card border-0 shadow-sm text-white bg-primary">
        <div class="card-body text-center py-2">
          <h6 class="fw-semibold mb-0 small">Vendas do Dia</h6>
          <p class="mb-0 small">{{ $dailySales }} vendas</p>
          <h6 class="mb-0">R$ {{ number_format($totalDailyValue, 2, ',', '.') }}</h6>
        </div>
      </div>

      <div class="card border-0 shadow-sm text-white bg-secondary">
        <div class="card-body text-center py-2">
          <h6 class="fw-semibold mb-0 small">Vendas do Mês</h6>
          <p class="mb-0 small">{{ $monthlySales }} vendas</p>
          <h6 class="mb-0">R$ {{ number_format($totalMonthlyValue, 2, ',', '.') }}</h6>
        </div>
      </div>
    </div>

    <div class="col-12 col-md-8">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body">
          <h6 class="fw-bold mb-2">Receitas e Despesas</h6>
          <canvas id="graficoReceitasDespesas" height="180"></canvas>
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
            <div class="progress mt-2" style="height: 6px;">
              <div class="progress-bar bg-success" role="progressbar"
                   style="width: {{ $item['percentage'] ?? 0 }}%;"
                   aria-valuenow="{{ $item['percentage'] ?? 0 }}"
                   aria-valuemin="0" aria-valuemax="100">
              </div>
            </div>
          </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>

<script>
  window.vendasMesesLabels = @json($months);
  window.vendasMesesData = @json($revenues);
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/financeiro.js') }}"></script>
@endsection
