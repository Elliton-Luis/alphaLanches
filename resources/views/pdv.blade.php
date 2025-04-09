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
                <label for="customer_id">Cliente (ID)</label>
                <input type="number" name="customer_id" class="form-control" required>
            </div>

            <h4>Produtos</h4>
            <div id="products-area">
                <div class="product-item row mb-2">
                    <div class="col-md-6">
                        <select name="items[0][product_id]" class="form-control">
                            @foreach($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }} - R${{ $product->price }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="items[0][quantity]" class="form-control" value="1" min="1">
                    </div>
                </div>
            </div>

            <button type="button" onclick="addProduct()" class="btn btn-secondary mb-3">+ Produto</button>
            <br>
            <button type="submit" class="btn btn-primary">Finalizar Venda</button>

            <script>
                let productIndex = 1;

                function addProduct() {
                    const area = document.getElementById('products-area');
                    const newItem = document.createElement('div');
                    newItem.className = 'product-item row mb-2';
                    newItem.innerHTML = `
                            <div class="col-md-6">
                                <select name="items[${productIndex}][product_id]" class="form-control">
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->name }} - R${{ $product->price }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" name="items[${productIndex}][quantity]" class="form-control" value="1" min="1">
                            </div>
                        `;
                    area.appendChild(newItem);
                    productIndex++;
                }
            </script>
    </div>
@endsection