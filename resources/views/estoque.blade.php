@extends('layouts.default')

@section('title', 'AlphaLanches - Estoque')

@section('content')
<div class="container">
    <h2>Controle de Estoque</h2>
    
    <button id="btn-add" class="btn btn-primary">Adicionar Produto</button>
    
    <form id="form-add" style="display: none; margin-top: 10px;" method="POST" action="{{ route('estoque.store') }}">
        @csrf
        <input type="text" id="name" name="name" placeholder="Nome" class="form-control mb-2">
        <input type="text" id="describe" name="describe" placeholder="Descrição" class="form-control mb-2">
        <input type="number" id="price" name="price" placeholder="Valor" class="form-control mb-2">
        <input type="number" id="amount" name="amount" placeholder="Quantidade" class="form-control mb-2">
        <select id="type" name="type" class="form-control mb-2">
            <option value="drink">Bebida</option>
            <option value="savory">Salgado</option>
            <option value="lunch">Almoço</option>
            <option value="snacks">Lanches</option>
            <option value="natural">Natural</option>
        </select>
        <button type="submit" class="btn btn-success">Salvar</button>
    </form>    
    
    <input type="text" id="search" placeholder="Buscar produto..." class="form-control my-3">
    
    <select id="filter-type" class="form-control my-3" onchange="filterByType()">
        <option value="">Todos</option>
        <option value="drink">Bebidas</option>
        <option value="savory">Salgados</option>
        <option value="lunch">Almoço</option>
        <option value="snacks">Lanches</option>
        <option value="natural">Natural</option>
    </select>
    
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="product-list">
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="updateStock({{ $product->id }}, -1)">-</button>
                    <span id="qtd-{{ $product->id }}">{{ $product->amount }}</span>
                    <button class="btn btn-sm btn-success" onclick="updateStock({{ $product->id }}, 1)">+</button>
                </td>
                <td>{{ ucfirst($product->type) }}</td>
                <td>
                    <input type="number" value="{{ $product->price }}" onchange="updateValue({{ $product->id }}, this.value)">
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    document.getElementById('btn-add').addEventListener('click', function () {
        document.getElementById('form-add').style.display = 'block';
    });

    function updateStock(id, change) {
        fetch(`/estoque/update-stock/${id}`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({ change: change })
        }).then(response => response.json())
          .then(data => {
              document.getElementById(`qtd-${id}`).innerText = data.amount;
          });
    }

    function updateValue(id, newValue) {
        fetch(`/estoque/update-value/${id}`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({ valor: newValue })
        });
    }

    function filterByType() {
        let type = document.getElementById('filter-type').value;
        window.location.href = `/estoque?type=${type}`;
    }
</script>
@endsection