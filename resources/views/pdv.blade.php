@extends('layouts.default')

@section('title', 'AlphaLanches - PDV')

@section('content')
    <div class="container mt-4 text">
        <h1 class="text-center mb-4">Painel PDV</h1>

        <br>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('pdv.store') }}">
            @csrf

            <div class="mb-3">
                <label for="customer_search">Cliente:</label>
                <input type="text" id="customer_search" class="form-control" placeholder="Digite o nome do cliente">
                <input type="hidden" name="customer_id" id="customer_id">
                <div id="customer_list" class="list-group position-absolute z-3"></div>
            </div>

            <div class="row">
                <!-- Lista de Produtos -->
                <div class="col-md-6">
                    <h4>Produtos</h4>
                    <ul class="list-group" id="product-list">
                        @foreach($products as $product)
                            <li class="list-group-item product-item" data-id="{{ $product->id }}"
                                data-name="{{ $product->name }}" data-price="{{ $product->price }}">
                                {{ $product->name }} - R${{ number_format($product->price, 2, ',', '.') }}
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="col-md-6">
                    <h4>Carrinho</h4>
                    <ul class="list-group mb-3" id="cart-list"></ul>

                    <input type="hidden" name="items_json" id="items_json">

                    <button type="submit" class="btn btn-success">Finalizar Venda</button>
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
            cart.forEach((item, index) => {
                list.innerHTML += `
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    ${item.name} x ${item.quantity}
                                    <span>R$ ${(item.price * item.quantity).toFixed(2)}</span>
                                </li>
                            `;
            });
            document.getElementById('items_json').value = JSON.stringify(cart.map(i => ({
                product_id: i.product_id,
                quantity: i.quantity
            })));
        }

        // Autocomplete de cliente
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
    </script>
@endsection