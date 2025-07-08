@extends('layouts.default')

@section('title', 'AlphaLanches - Financeiro')

@section('content')
<style>
  #graficoReceitasDespesas {
    height: 120px; /* altura fixa */
    max-height: 60vh;
    width: 100% !important; /* responsivo na largura */
    display: block;
  }
  /* Transição suave para botão toggle */
  #btnToggleResumo {
    transition: background-color 0.3s ease, color 0.3s ease;
  }
</style>

<div class="container my-5">
  <h2 class="text-center fw-bold mb-4 display-6">Painel Financeiro</h2>

  <!-- Gráfico Receita dos Últimos Meses -->
  <div class="card border-0 shadow-lg rounded-4 mb-4">
    <div class="card-body p-4">
      <h5 class="fw-bold mb-4">Receita dos Últimos Meses</h5>
      <canvas id="graficoReceitasDespesas" height="120"></canvas>
    </div>
  </div>

  <!-- Botão toggle -->
  <div class="text-center mb-4">
    <button 
      class="btn btn-outline-primary rounded-pill px-4" 
      type="button" 
      data-bs-toggle="collapse" 
      data-bs-target="#cardsFinanceiro" 
      aria-expanded="false" 
      aria-controls="cardsFinanceiro" 
      id="btnToggleResumo"
    >
      📊 Ver Resumo Financeiro
    </button>
  </div>

  <!-- Cards resumidos colapsáveis -->
  <div class="collapse" id="cardsFinanceiro">
    <div class="row g-4">

      <div class="col-12 col-md-4">
        <div class="row g-3">

          <!-- Receita Atual (total verde) -->
          <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm bg-success-subtle">
              <div class="card-body text-center py-3">
                <h5 class="fw-light mb-1 text-success">Receita Atual</h5>
                <h4 class="fw-bold mb-0 text-success">R$ {{ number_format($totalSalesValue, 2, ',', '.') }}</h4>
              </div>
            </div>
          </div>

          <!-- Vendas do Dia (cinza) -->
          <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm bg-secondary-subtle">
              <div class="card-body text-center py-3">
                <h5 class="fw-light mb-1 text-dark">Vendas do Dia</h5>
                <h5 class="fw-bold mb-0 text-dark">{{ $dailySales }} vendas</h5>
                <small class="fs-6 text-muted">R$ {{ number_format($totalDailyValue, 2, ',', '.') }}</small>
              </div>
            </div>
          </div>

          <!-- Vendas do Mês (cinza claro) -->
          <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm bg-light-subtle">
              <div class="card-body text-center py-3">
                <h5 class="fw-light mb-1 text-dark">Vendas do Mês</h5>
                <h5 class="fw-bold mb-0 text-dark">{{ $monthlySales }} vendas</h5>
                <small class="fs-6 text-muted">R$ {{ number_format($totalMonthlyValue, 2, ',', '.') }}</small>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="row g-3">

          <!-- Itens Vendidos (cinza escuro) -->
          <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm bg-body-secondary">
              <div class="card-body text-center py-3">
                <h5 class="fw-light mb-1 text-dark">Itens Vendidos</h5>
                <h4 class="fw-bold mb-0 text-dark">{{ $totalItemsSold }}</h4>
              </div>
            </div>
          </div>

          <!-- Ticket Médio do Dia (cinza escuro) -->
          <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm bg-dark-subtle">
              <div class="card-body text-center py-3">
                <h5 class="fw-light mb-1 text-dark">Ticket Médio Hoje</h5>
                <h5 class="fw-bold mb-0 text-dark">R$ {{ number_format($averageDailyTicket, 2, ',', '.') }}</h5>
              </div>
            </div>
          </div>

          <!-- Ticket Médio do Mês (cinza médio) -->
          <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm bg-secondary-subtle">
              <div class="card-body text-center py-3">
                <h5 class="fw-light mb-1 text-dark">Ticket Médio Mês</h5>
                <h5 class="fw-bold mb-0 text-dark">R$ {{ number_format($averageMonthlyTicket, 2, ',', '.') }}</h5>
              </div>
            </div>
          </div>

        </div>
      </div>

      <div class="col-12 col-md-4">
        <div class="row g-3">

          <!-- Receita 6 meses (total verde) -->
          <div class="col-12">
            <div class="card border-0 rounded-4 shadow-sm bg-success-subtle">
              <div class="card-body text-center py-3">
                <h5 class="fw-light mb-1 text-success">Receita 6 Meses</h5>
                <h5 class="fw-bold mb-0 text-success">R$ {{ number_format($accumulatedRevenue, 2, ',', '.') }}</h5>
              </div>
            </div>
          </div>

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
                <i class="fas fa-medal text-dark"></i>
              @elseif($loop->iteration == 3)
                <i class="fas fa-medal text-dark"></i>
              @else
                <i class="fas fa-star text-muted"></i>
              @endif
              {{ $item['name'] }}
            </span>
            <span class="badge bg-success rounded-pill">{{ $item['quantity'] }} unidades</span>
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

  // Toggle texto do botão
  const btnToggleResumo = document.getElementById('btnToggleResumo');
  const collapseResumo = document.getElementById('cardsFinanceiro');

  collapseResumo.addEventListener('shown.bs.collapse', () => {
    btnToggleResumo.innerHTML = '📊 Ocultar Resumo Financeiro';
  });
  collapseResumo.addEventListener('hidden.bs.collapse', () => {
    btnToggleResumo.innerHTML = '📊 Ver Resumo Financeiro';
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/financeiro.js') }}"></script>
@endsection
