@extends('layouts.default')

@section('title', 'AlphaLanches - Estoque')

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

@section('content')

    <script src="{{ asset('js/estoque.js') }}"></script>

    <div class="container">
        <h2 class="text-center mb-5">Controle de Estoque</h2>

        <br>

        <button id="btn-add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">Adicionar Produto</button>

        <div id="modal-add" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicionar Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="form-add" method="POST" action="{{ route('estoque.store') }}">
                            @csrf
                            <input type="text" id="name" name="name" placeholder="Nome" class="form-control mb-3">
                            <input type="text" id="describe" name="describe" placeholder="Descrição"
                                class="form-control mb-3">
                            <input type="number" id="price" name="price" placeholder="Valor" class="form-control mb-3" step="0.01">
                            <input type="number" id="amount" name="amount" placeholder="Quantidade"
                                class="form-control mb-3">
                            <select id="type" name="type" class="form-control mb-3">
                                <option value="drink">Bebida</option>
                                <option value="savory">Salgado</option>
                                <option value="lunch">Almoço</option>
                                <option value="snacks">Lanches</option>
                                <option value="natural">Natural</option>
                            </select>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

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
                    <th>Valor</th>
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
                            <input type="number" value="{{ $product->price }}"
                                onchange="updateValue({{ $product->id }}, this.value)">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
