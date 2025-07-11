@extends('layouts.default')

@section('title', 'AlphaLanches - Agendamento')

@section('content')
    <div class="container mt-4 text">
        <h2 class="text-center mb-5">Painel Agendamento</h2>

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

        <form id="agendamento-form" method="POST" action="{{ route('agendamento.store') }}">
            @csrf

            <div class="d-flex flex-column align-items-center">
                
                <div class="border border-primary rounded mb-3 p-3" style="width: 100%; max-width: 600px;">
                    <h4>Produtos</h4>
                    <div class="input-group mb-2">
                        <input id="searchName" class="form-control border-primary" type="text"
                            placeholder="Digite o nome do produto">
                        <select id="searchType" class="form-select border-primary">
                            <option value="">Todos os Tipos</option>
                            <option value="drink">Bebida</option>
                            <option value="savory">Salgado</option>
                            <option value="lunch">Almoço</option>
                            <option value="snacks">Lanches</option>
                            <option value="natural">Natural</option>
                        </select>
                    </div>

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
                                        <span class="badge bg-secondary">Disponivel: {{ $product->available }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="border border-primary rounded mb-3 p-3" style="width: 100%; max-width: 600px;">
                    <h4>Carrinho</h4>
                    <ul class="list-group mb-3" id="cart-list"></ul>

                    <input type="hidden" name="items_json" id="items_json">

                    <div class="mb-3">
                        <label for="payment_method">Forma de Pagamento:</label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="dinheiro">Dinheiro</option>
                            <option value="credit">Crédito</option>
                            <option value="cartao">Cartão</option>
                            <option value="pix">PIX</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="scheduled_date">Data da Pedido:</label>
                        <input type="date" name="scheduled_date" id="scheduled_date" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success">Finalizar Venda</button>

                    <div class="mb-3">
                        <br>

                        <h5>Total: <span id="total_price" class="text-success fw-bold">R$ 0,00</span></h5>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <button type="button" class="btn btn-info my-3" data-bs-toggle="modal" data-bs-target="#pedidosModal">
        Ver Pedidos
    </button>

    <div class="modal fade" id="pedidosModal" tabindex="-1" aria-labelledby="pedidosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Meus Pedidos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <h5>Pedidos em Espera</h5>
                    @forelse($pedidosEspera as $pedido)
                        <div class="border p-2 mb-2">
                            <p><strong>Data:</strong> {{ $pedido->scheduled_date }}</p>
                            <p><strong>Total:</strong> R$ {{ number_format($pedido->value, 2, ',', '.') }}</p>
                            <form method="POST" action="{{ route('agendamento.cancelar', $pedido->id) }}">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-sm btn-danger">Cancelar Pedido</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-muted">Nenhum pedido em espera.</p>
                    @endforelse

                    <hr>

                    <h5>Pedidos Concluídos</h5>
                    @forelse($pedidosConcluidos as $pedido)
                        <div class="border p-2 mb-2">
                            <p><strong>Data:</strong> {{ $pedido->scheduled_date }}</p>
                            <p><strong>Total:</strong> R$ {{ number_format($pedido->value, 2, ',', '.') }}</p>
                            <span class="badge bg-success">Concluído</span>
                        </div>
                    @empty
                        <p class="text-muted">Nenhum pedido Concluído.</p>
                    @endforelse

                    <hr>

                    <h5>Pedidos Cancelados</h5>
                    @forelse($pedidosCancelados as $pedido)
                        <div class="border p-2 mb-2">
                            <p><strong>Data:</strong> {{ $pedido->scheduled_date }}</p>
                            <p><strong>Total:</strong> R$ {{ number_format($pedido->value, 2, ',', '.') }}</p>
                            <span class="badge bg-danger">Cancelado</span>
                        </div>
                    @empty
                        <p class="text-muted">Nenhum pedido cancelado.</p>
                    @endforelse
                </div>
            </div>
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

    <script src="{{ asset('js/agendamento.js') }}"></script>
@endsection