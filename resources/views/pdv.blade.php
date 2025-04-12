@extends('layouts.default')

@section('title', 'AlphaLanches - PDV')

@section('content')
    <div class="container mt-4">
        <h1 class="text-center mb-4 fw-bold">Painel PDV</h1>

        @if(isset($todayTotal))
            <div class="alert alert-info text-center">
                <strong>Total de Vendas Hoje:</strong> R$ {{ number_format($todayTotal, 2, ',', '.') }}
            </div>
        @endif

        <div id="alert-container"></div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(Session::has('errorAuth'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('errorAuth') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form id="pdv-form" method="POST" action="{{ route('pdv.store') }}">
            @csrf

            <div class="mb-4">
                <label for="customer_search" class="form-label fw-bold">Buscar Cliente:</label>
                <div class="position-relative">
                    <input type="text" id="customer_search" class="form-control" placeholder="Digite o nome do cliente">
                    <input type="hidden" name="customer_id" id="customer_id">
                    <div id="customer_list" class="list-group position-absolute w-100 z-3"></div>
                </div>
            </div>

            <div class="row g-4">
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Produtos</h4>
                        </div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input id="searchName" class="form-control" type="text" placeholder="Digite o nome do produto">
                                <select id="searchType" class="form-select">
                                    <option value="">Todos os Tipos</option>
                                    <option value="drink">Bebida</option>
                                    <option value="savory">Salgado</option>
                                    <option value="lunch">Almoço</option>
                                    <option value="snacks">Lanches</option>
                                    <option value="natural">Natural</option>
                                </select>
                            </div>

                            <ul class="list-group" id="product-list" style="max-height: 300px; overflow-y: auto;">
                                @foreach($products as $product)
                                    <li class="list-group-item product-item d-flex justify-content-between align-items-center"
                                        data-id="{{ $product->id }}"
                                        data-name="{{ $product->name }}"
                                        data-price="{{ $product->price }}"
                                        data-amount="{{ $product->amount }}"
                                        data-type="{{ $product->type }}"
                                        data-describe="{{ $product->describe }}">
                                        <div>
                                            <strong>{{ $product->name }}</strong>
                                            <br>
                                            <small class="text-muted">{{ $product->type }} - {{ $product->describe ?? 'Sem descrição' }}</small>
                                        </div>
                                        <div>
                                            <span class="badge bg-primary">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                                            <br>
                                            <span class="badge bg-secondary">Estoque: {{ $product->amount }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h4 class="mb-0">Carrinho</h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-group mb-3" id="cart-list" style="max-height: 300px; overflow-y: auto;"></ul>

                            <input type="hidden" name="items_json" id="items_json">

                            <div class="mb-3">
                                <label for="payment_method" class="form-label fw-bold">Forma de Pagamento:</label>
                                <select name="payment_method" id="payment_method" class="form-select" required>
                                    <option value="">Selecione</option>
                                    <option value="dinheiro">Dinheiro</option>
                                    <option value="credit">Crédito</option>
                                    <option value="cartao">Cartão</option>
                                    <option value="pix">PIX</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Total: <span id="total_price" class="text-success fw-bold">R$ 0,00</span></h5>
                                <button type="submit" class="btn btn-success">Finalizar Venda</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Reposição Rápida</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('repor') }}">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-8">
                                <select name="product_id" class="form-select">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <input type="number" name="amount" class="form-control" placeholder="Quantidade">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-warning mt-3 w-100">Repor Estoque</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
