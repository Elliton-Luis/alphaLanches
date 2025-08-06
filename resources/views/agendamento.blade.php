@extends('layouts.default')

@section('title', 'AlphaLanches - Agendamento')

@section('content')
<div class="container my-4">
    <h2 class="text-center mb-4">Painel Agendamento</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(Session::has('errorAuth'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('errorAuth') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
        </div>
    @endif

    @if(auth()->user()->type === 'guard' && count($students))
        <div class="mb-3">
            <label for="student_id">Escolher estudante:</label>
            <select name="student_id" id="student_id" class="form-select" required>
                <option value="">Selecione</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
    @endif

    <form id="agendamento-form" method="POST" action="{{ route('agendamento.store') }}">
        @csrf
        <div class="row">
            <!-- Lista de Produtos -->
            <div class="col-12 col-md-6 mb-3">
                <div class="p-3 border rounded-3">
                    <h4 class="mb-3">Produtos</h4>
                    <div class="input-group mb-3">
                        <input id="searchName" class="form-control" type="text" placeholder="Buscar produto">
                        <select id="searchType" class="form-select">
                            <option value="">Todos</option>
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
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <strong>{{ $product->name }}</strong><br>
                                        <small class="text-muted">{{ $product->type }} - {{ $product->describe ?? 'Sem descrição' }}</small>
                                    </div>
                                    <div>
                                        <span
                                            class="badge bg-primary">R${{ number_format($product->price, 2, ',', '.') }}</span>
                                        <br>
                                        <span class="badge bg-secondary">Disponível: {{ $product->available }}</span>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Carrinho e Agendamento -->
            <div class="col-12 col-md-6 mb-3">
                <div class="p-3 border rounded-3">
                    <h4 class="mb-3">Carrinho</h4>
                    <ul class="list-group mb-3" id="cart-list"></ul>
                    <input type="hidden" name="items_json" id="items_json">

                    <div class="mb-3">
                        <label for="payment_method">Pagamento:</label>
                        <select name="payment_method" id="payment_method" class="form-select" required>
                            <option value="">Selecione</option>
                            <option value="dinheiro">Dinheiro</option>
                            <option value="credit">Crédito</option>
                            <option value="cartao">Cartão</option>
                            <option value="pix">PIX</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="scheduled_date">Data do Pedido:</label>
                        <input type="date" name="scheduled_date" id="scheduled_date" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success w-100 mb-2">Finalizar Venda</button>

                    <div class="mb-3">
                        <br>
                        <h5>Total: <span id="total_price" class="text-success fw-bold">R$ 0,00</span></h5>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Botões de Pedidos -->
    <div class="text-center my-3 d-flex justify-content-center gap-2 flex-wrap">
        <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#pedidosModal">
            Meus Pedidos
        </button>

        @if(auth()->user()->type === 'guard')
            <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#pedidosEstudantesModal">
                Pedidos Estudantes
            </button>
        @endif
    </div>


    <!-- Modal Pedidos -->
    <div class="modal fade" id="pedidosModal" tabindex="-1" aria-labelledby="pedidosModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Meus Pedidos</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">

                    <h5>Pedidos em Espera</h5>
                    @forelse($pedidosEspera as $pedido)
                        <div class="border rounded p-2 mb-3">
                            <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($pedido->scheduled_date)->format('d/m/Y') }}</p>
                            <p><strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>

                            <p><strong>Itens:</strong></p>
                            <ul>
                                @foreach($pedido->items as $item)
                                    <li>{{ $item->product->name }} - Quantidade: {{ $item->quantity }}</li>
                                @endforeach
                            </ul>
                            <form method="POST" action="{{ route('agendamento.cancelar', $pedido->id) }}">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-outline-danger btn-sm w-100">Cancelar</button>
                            </form>
                        </div>
                    @empty
                        <p class="text-muted">Nenhum pedido em espera.</p>
                    @endforelse

                    <hr>

                    <!-- Concluídos -->
                    <h5>Concluídos</h5>
                    @forelse($pedidosConcluidos as $pedido)
                        <div class="border rounded p-2 mb-3">
                            <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($pedido->scheduled_date)->format('d/m/Y') }}</p>
                            <p><strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>

                            <p><strong>Itens:</strong></p>
                            <ul>
                                @foreach($pedido->items as $item)
                                    <li>{{ $item->product->name }} - Quantidade: {{ $item->quantity }}</li>
                                @endforeach
                            </ul>
                            <span class="badge bg-success">Concluído</span>
                        </div>
                    @empty
                        <p class="text-muted">Nenhum pedido concluído.</p>
                    @endforelse

                    <hr>

                    <!-- Cancelados -->
                    <h5>Cancelados</h5>
                    @forelse($pedidosCancelados as $pedido)
                        <div class="border rounded p-2 mb-3">
                            <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($pedido->scheduled_date)->format('d/m/Y') }}</p>
                            <p><strong>Total:</strong> R$ {{ number_format($pedido->total, 2, ',', '.') }}</p>

                            <p><strong>Itens:</strong></p>
                            <ul>
                                @foreach($pedido->items as $item)
                                    <li>{{ $item->product->name }} - Quantidade: {{ $item->quantity }}</li>
                                @endforeach
                            </ul>
                            <span class="badge bg-danger">Cancelado</span>
                        </div>
                    @empty
                        <p class="text-muted">Nenhum pedido cancelado.</p>
                    @endforelse

                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pedidos Estudantes -->
    <div class="modal fade" id="pedidosEstudantesModal" tabindex="-1" aria-labelledby="pedidosEstudantesModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pedidos dos Estudantes</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    @forelse($students as $student)
                        <div class="mb-4">
                            <h5 class="border-bottom pb-1">{{ $student->name }}</h5>

                            @php
                                $pedidosAgrupados = $student->reservedProducts->groupBy(fn($r) => $r->sale->status);
                            @endphp

                            {{-- Em Espera --}}
                            @if(isset($pedidosAgrupados['em espera']))
                                <h6 class="mt-3">Em Espera</h6>
                                @foreach($pedidosAgrupados['em espera'] as $pedido)
                                    <div class="border rounded p-2 mb-3">
                                        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($pedido->sale->scheduled_date)->format('d/m/Y') }}</p>
                                        <p><strong>Produto:</strong> {{ $pedido->product->name }}</p>
                                        <p><strong>Quantidade:</strong> {{ $pedido->quantity }}</p>

                                        <form method="POST" action="{{ route('agendamento.cancelar', $pedido->sale->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-outline-danger btn-sm w-100">Cancelar Pedido</button>
                                        </form>
                                    </div>
                                @endforeach
                            @endif

                            {{-- Concluídos --}}
                            @if(isset($pedidosAgrupados['concluido']))
                                <h6 class="mt-3">Concluídos</h6>
                                @foreach($pedidosAgrupados['concluido'] as $pedido)
                                    <div class="border rounded p-2 mb-3">
                                        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($pedido->sale->scheduled_date)->format('d/m/Y') }}</p>
                                        <p><strong>Produto:</strong> {{ $pedido->product->name }}</p>
                                        <p><strong>Quantidade:</strong> {{ $pedido->quantity }}</p>
                                        <span class="badge bg-success">Concluído</span>
                                    </div>
                                @endforeach
                            @endif

                            {{-- Cancelados --}}
                            @if(isset($pedidosAgrupados['cancelado']))
                                <h6 class="mt-3">Cancelados</h6>
                                @foreach($pedidosAgrupados['cancelado'] as $pedido)
                                    <div class="border rounded p-2 mb-3">
                                        <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($pedido->sale->scheduled_date)->format('d/m/Y') }}</p>
                                        <p><strong>Produto:</strong> {{ $pedido->product->name }}</p>
                                        <p><strong>Quantidade:</strong> {{ $pedido->quantity }}</p>
                                        <span class="badge bg-danger">Cancelado</span>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                        <hr>
                    @empty
                        <p class="text-muted">Nenhum estudante vinculado ao responsável.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/agendamento.js') }}"></script>
@endsection

<style>
    .list-group-item {
        transition: background-color 0.3s ease;
    }
    .list-group-item:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }
</style>