@extends('layouts.default')

@section('title', 'AlphaLanches - PDV')

@section('content')
    <div class="container mt-4 text">
        <h2 class="text-center mb-5">Painel PDV</h2>

        @if(isset($todayTotal))
            <div class="alert alert-info text-center">
                Total de Vendas Hoje: <strong>R$ {{ number_format($todayTotal, 2, ',', '.') }}</strong>
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

            <div class="row">
                <div class="col-md-6 border border-primary rounded" style="padding-top: 10px;">
                    <h4>Produtos</h4>


                    <ul class="list-group" id="product-list">
                        @foreach($products as $product)
                            <li class="list-group-item product-item" data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}" data-price="{{ $product->price }}"
                                data-amount="{{ $product->amount }}" data-type="{{ $product->type }}"
                                data-describe="{{ $product->describe }}">

                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>{{ $product->name }}</strong>
                                        <br>
                                        <small class="text-muted">
                                            {{ $product->type }} - {{ $product->describe ?? 'Sem descrição' }}
                                        </small>
                                    </div>
                                    <div>
                                        <span
                                            class="badge bg-primary">R${{ number_format($product->price, 2, ',', '.') }}</span>
                                        <br>
                                        <span class="badge bg-secondary">Estoque: {{ $product->amount }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-6">
                    <h4>Carrinho</h4>
                    <ul class="list-group mb-3" id="cart-list"></ul>

                    <input type="hidden" name="items_json" id="items_json">

                    <div class="mb-3">
                        <label for="payment_method">Forma de Pagamento:</label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="dinheiro">Dinheiro</option>
                            <option value="cartao">Cartão</option>
                            <option value="pix">PIX</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Finalizar Venda</button>

                    <div class="mb-3">
                        <br>

                        <h5>Total: <span id="total_price" class="text-success fw-bold">R$ 0,00</span></h5>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-md-6" style="margin-top: 10px;">
            <h5>Reposição Rápida</h5>
            <form method="POST" action="{{ route('repor') }}">
                @csrf
                <select name="product_id" class="form-select mb-2">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                <input type="number" name="amount" class="form-control mb-2" placeholder="Quantidade">
                <button type="submit" class="btn btn-warning">Repor Estoque</button>
            </form>
        </div>
    </div>

    <style>
        .list-group-item {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .list-group-item:hover {
            background-color: #91b6ee;
            cursor: pointer;
        }
    </style>

    <script src="{{ asset('js/pdv.js') }}"></script>
@endsection