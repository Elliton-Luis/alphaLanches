<h2>Relatório de Vendas</h2>
<p><strong>Usuário:</strong> {{ $usuario }}</p>
<p><strong>Período:</strong> {{ $inicio }} a {{ $fim }}</p>

<hr>

<p><strong>Total de Vendas:</strong> R$ {{ number_format($totalVendas, 2, ',', '.') }}</p>
<p><strong>Número de Vendas:</strong> {{ $numVendas }}</p>
<p><strong>Ticket Médio:</strong> R$ {{ number_format($ticketMedio, 2, ',', '.') }}</p>
<p><strong>Forma de Pagamento Mais Usada:</strong> {{ $formaMaisUsada }}</p>
<p><strong>Produto Mais Vendido:</strong> {{ $produtoMaisVendido }}</p>

<hr>

<h3>Top 10 Produtos Mais Vendidos</h3>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Produto</th>
            <th>Quantidade Vendida</th>
            <th>Preço Unitário</th>
            <th>Total (R$)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto['nome'] }}</td>
                <td>{{ $produto['quantidade'] }}</td>
                <td>R$ {{ number_format($produto['preco_unitario'], 2, ',', '.') }}</td>
                <td>R$ {{ number_format($produto['total'], 2, ',', '.') }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<hr>

<h3>Formas de Pagamento</h3>
<table border="1" cellpadding="5" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Forma de Pagamento</th>
            <th>Total em R$</th>
            <th>% das Vendas</th>
        </tr>
    </thead>
    <tbody>
        @foreach($formasPagamento as $forma => $info)
            <tr>
                <td>{{ $forma }}</td>
                <td>R$ {{ number_format($info['total'], 2, ',', '.') }}</td>
                <td>{{ number_format($info['percentual'], 2, ',', '.') }}%</td>
            </tr>
        @endforeach
    </tbody>
</table>