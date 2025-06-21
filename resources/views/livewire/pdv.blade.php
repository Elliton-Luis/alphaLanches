<div>
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

        <form id="pdv-form">
            @csrf

            <div class="row">
                <div class="col-md-6 rounded p-3 shadow-sm bg-white">
    <h4 class="mb-4">Produtos</h4>

        <div class="mb-3">
            <input type="text" id="filterName" wire:model.lazy="filterName" 
                class="form-control form-control-sm" placeholder="Digite o nome do produto...">
        </div>

                <ul class="list-group list-group-flush" id="product-list" style="max-height: 500px; overflow-y: auto;">
                    @foreach($products as $product)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-2 py-2" wire:click="fillCart( {{$product->id}} )">
                            <div>
                                <strong>{{ $product->name }}</strong><br>
                                <small class="text-muted" style="font-size: 0.85rem;">
                                    {{ $product->tipo_traduzido }} - {{ $product->describe ?? 'Sem descrição' }}
                                </small>
                            </div>
                            <div class="text-end">
                                <span class="badge rounded-pill bg-primary px-3 py-1 fs-6">
                                    R$ {{ number_format($product->price, 2, ',', '.') }}
                                </span>
                                <br>
                                <small class="badge bg-secondary" style="font-size: 0.75rem;">Estoque: {{ $product->amount }}</small>
                            </div>

                        </li>
                    @endforeach
                </ul>

            <div class="mt-3">
                {{ $products->links('vendor.livewire.bootstrap', ['scrollTo' => false]) }}
            </div>
        </div>
                <div class="col-md-6">
                    <h4>Carrinho</h4>

                    <div class="list-group">
                    @foreach ($cartItems as $item)
                        <div class="d-flex align-items-center py-2 border-bottom">
                            <small class="text-body-secondary flex-grow-1" style="min-width: 160px;">{{ $item->name }}</small>
                            <small class="text-body-secondary text-end" style="width: 90px;">R$ {{ number_format($item->price, 2, ',', '.') }}</small>
                            <small class="text-body-secondary text-end" style="width: 60px;">x{{ $item->quantity }}</small>
                        </div>

                        @php $total += $item->price * $item->quantity; @endphp
                    @endforeach

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

                    <button type="submit" class="btn btn-success" wire:click="emptyCart()">Finalizar Venda</button>

                    <div class="mb-3">
                        <br>

                        <h5>Total: <span id="total_price" class="text-success fw-bold">R$ {{ number_format($total, 2, ',', '.') }}</span></h5>
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
</div>
