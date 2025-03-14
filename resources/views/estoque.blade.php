@extends('layouts.default')

@section('title', 'AlphaLanches - Estoque')

@section('content')
<div class="container">
    <h2>Controle de Estoque</h2>
    
    {{-- Botão para adicionar novo produto --}}
    <button id="btn-add" class="btn btn-primary">Adicionar Produto</button>
    
    {{-- Formulário oculto para adicionar produtos --}}
    <div id="form-add" style="display: none; margin-top: 10px;">
        <input type="text" id="nome" placeholder="Nome" class="form-control mb-2">
        <input type="text" id="descricao" placeholder="Descrição" class="form-control mb-2">
        <input type="number" id="valor" placeholder="Valor" class="form-control mb-2">
        <input type="number" id="quantidade" placeholder="Quantidade" class="form-control mb-2">
        <button id="btn-save" class="btn btn-success">Salvar</button>
    </div>
    
    {{-- Campo de busca e botão de filtro --}}
    <input type="text" id="search" placeholder="Buscar produto..." class="form-control my-3">
    <button id="btn-filter" class="btn btn-secondary">Filtros</button>
    
    {{-- Tabela de produtos --}}
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="product-list">
            @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto->nome }}</td>
                <td>
                    <button class="btn btn-sm btn-danger" onclick="updateStock({{ $produto->id }}, -1)">-</button>
                    <span id="qtd-{{ $produto->id }}">{{ $produto->quantidade }}</span>
                    <button class="btn btn-sm btn-success" onclick="updateStock({{ $produto->id }}, 1)">+</button>
                </td>
                <td>
                    <input type="number" value="{{ $produto->valor }}" onchange="updateValue({{ $produto->id }}, this.value)">
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
        fetch(`/estoque/${id}/updateStock`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({ change: change })
        }).then(response => response.json())
          .then(data => {
              document.getElementById(`qtd-${id}`).innerText = data.quantidade;
          });
    }

    function updateValue(id, newValue) {
        fetch(`/estoque/${id}/updateValue`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
            body: JSON.stringify({ valor: newValue })
        });
    }
</script>
@endsection