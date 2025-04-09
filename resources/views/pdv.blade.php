@extends('layouts.default')

@section('title', 'AlphaLanches - PDV')

@section('content')
    <div class="container mt-4 text">
        <h1 class="text-center mb-4">Painel PDV</h1>

        @if(isset($todayTotal))
            <div class="alert alert-info text-center">
                Total de Vendas Hoje: <strong>R$ {{ number_format($todayTotal, 2, ',', '.') }}</strong>
            </div>
        @endif

        <div id="alert-container"></div>


        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form id="pdv-form" method="POST" action="{{ route('pdv.store') }}">
            @csrf

            <div class="mb-3 border border-primary rounded">
                <input type="text" id="customer_search" class="form-control" placeholder="Digite o nome do cliente">
                <input type="hidden" name="customer_id" id="customer_id">
                <div id="customer_list" class="list-group position-absolute z-3"></div>
            </div>

            <div class="row">
                <div class="col-md-6 border border-primary rounded" style="padding-top: 10px;">
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
                            <option value="cartao_credito">Cartão de Crédito</option>
                            <option value="cartao_debito">Cartão de Débito</option>
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
    </div>

    <script>
        let cart = [];

        document.querySelectorAll('.product-item').forEach(item => {
            item.addEventListener('click', function () {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const price = parseFloat(this.dataset.price);

                const found = cart.find(p => p.product_id == id);
                if (found) {
                    found.quantity += 1;
                } else {
                    cart.push({ product_id: id, name, price, quantity: 1 });
                }

                updateCart();
            });
        });

        function updateCart() {
            const list = document.getElementById('cart-list');
            list.innerHTML = '';
            let total = 0;

            cart.forEach((item, index) => {
                const subtotal = item.price * item.quantity;
                total += subtotal;

                list.innerHTML += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div style="display: contents;">
                                <div>${item.name}</div>
                                <div><input type="number" min="1" value="${item.quantity}" data-index="${index}" class="form-control d-inline w-auto quantity-input" style="width: 60px;" /></div>
                                <div><span class="ms-2">R$ ${subtotal.toFixed(2)}</span></div>
                                <div>
                                <button class="btn btn-sm btn-danger remove-item" data-index="${index}">
                                <i class="bi bi-trash"></i>
                                </div>
                                </button>
                            </div>
                        </li>
                    `;
            });

            document.getElementById('total_price').textContent = `R$ ${total.toFixed(2)}`;
            document.getElementById('items_json').value = JSON.stringify(cart.map(i => ({
                product_id: i.product_id,
                quantity: i.quantity
            })));
        }

        document.addEventListener('click', function (e) {
            if (e.target.closest('.remove-item')) {
                const index = e.target.closest('.remove-item').dataset.index;
                cart.splice(index, 1);
                updateCart();
            }
        });

        document.addEventListener('input', function (e) {
            if (e.target.classList.contains('quantity-input')) {
                const index = e.target.dataset.index;
                const newQty = parseInt(e.target.value);
                if (newQty > 0) {
                    cart[index].quantity = newQty;
                    updateCart();
                }
            }
        });


        const input = document.getElementById('customer_search');
        const list = document.getElementById('customer_list');

        input.addEventListener('input', function () {
            const query = this.value;

            if (query.length < 1) {
                list.innerHTML = '';
                return;
            }

            fetch(`{{ route('searchUser') }}?query=${query}`)
                .then(res => res.json())
                .then(data => {
                    console.log(data);
                    list.innerHTML = '';
                    data.forEach(c => {
                        const item = document.createElement('a');
                        item.href = "#";
                        item.classList.add('list-group-item', 'list-group-item-action');
                        item.textContent = c.name;
                        item.addEventListener('click', () => {
                            input.value = c.name;
                            document.getElementById('customer_id').value = c.id;
                            list.innerHTML = '';
                        });
                        list.appendChild(item);
                    });
                });
        });

        const searchName = document.getElementById('searchName');
        const searchType = document.getElementById('searchType');
        const allProducts = Array.from(document.querySelectorAll('.product-item'));

        function filterProducts() {
            const nameFilter = searchName.value.toLowerCase();
            const typeFilter = searchType.value;

            allProducts.forEach(product => {
                const name = product.dataset.name.toLowerCase();
                const type = product.dataset.type;

                const matchesName = name.includes(nameFilter);
                const matchesType = !typeFilter || type === typeFilter;

                product.style.display = (matchesName && matchesType) ? 'block' : 'none';
            });
        }

        searchName.addEventListener('input', filterProducts);
        searchType.addEventListener('change', filterProducts);

        function showAlert(message, type = 'danger') {
            const alertContainer = document.getElementById('alert-container');

            alertContainer.innerHTML = '';

            const alertElement = document.createElement('div');
            alertElement.className = `alert alert-${type} alert-dismissible fade show`;
            alertElement.role = 'alert';
            alertElement.innerHTML = `
                                        ${message}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    `;

            alertContainer.appendChild(alertElement);
        }


        document.getElementById('pdv-form').addEventListener('submit', function (e) {
            const customerId = document.getElementById('customer_id').value;
            const cartItems = JSON.parse(document.getElementById('items_json').value || '[]');

            // Remove alertas anteriores
            document.querySelectorAll('.alert').forEach(el => el.remove());

            if (!customerId) {
                e.preventDefault();
                showAlert('Por favor, selecione um cliente antes de finalizar a venda.');
                return;
            }

            if (cartItems.length === 0) {
                e.preventDefault();
                showAlert('Adicione pelo menos um produto ao carrinho antes de finalizar a venda.');
                return;
            }
        });

    </script>
@endsection