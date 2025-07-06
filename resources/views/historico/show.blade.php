@extends('layouts.default')
@section('title', 'AlphaLanches - Historico')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Detalhes da Compra</h4>
                    <a href="{{ route('historico.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Voltar
                    </a>
                </div>

                <div class="card-body">
                    <!-- Informações da venda -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h5>Informações Gerais</h5>
                            <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($venda->saleDate)->format('d/m/Y') }}</p>
                            @if(Auth::user()->isAdmin())
                                <p><strong>Cliente:</strong> {{ $venda->user->name }}</p>
                            @endif
                            <p><strong>Valor Total:</strong>
                                <span class="badge badge-success fs-6 text-success">
                                    R$ {{ number_format($venda->value, 2, ',', '.') }}
                                </span>
                            </p>
                        </div>
                        <div class="col-md-6">
                            <h5>Resumo da Compra</h5>
                            <p><strong>Quantidade de Itens:</strong> {{ $venda->saleProducts->sum('productQuantity') }}</p>
                            <p><strong>Tipos de Produtos:</strong> {{ $venda->saleProducts->count() }}</p>
                        </div>
                    </div>

                    <!-- Itens da compra -->
                    <h5>Itens Comprados</h5>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Tipo</th>
                                    <th>Quantidade</th>
                                    <th>Preço Unitário</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $valorCalculado = 0; @endphp
                                @foreach($venda->saleProducts as $item)
                                    @php
                                        $subtotal = $item->productQuantity * $item->product->price;
                                        $valorCalculado += $subtotal;
                                    @endphp
                                    <tr>
                                        <td>
                                            <strong>{{ $item->product->name }}</strong>
                                            @if($item->product->describe)
                                                <br><small class="text-muted">{{ $item->product->describe }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge badge-info text-dark">
                                                {{ $item->product->tipo_traduzido }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary text-dark">
                                                {{ $item->productQuantity }}
                                            </span>
                                        </td>
                                        <td>R$ {{ number_format($item->product->price, 2, ',', '.') }}</td>
                                        <td>
                                            <strong>R$ {{ number_format($subtotal, 2, ',', '.') }}</strong>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-success">
                                    <th colspan="4">Total</th>
                                    <th>R$ {{ number_format($valorCalculado, 2, ',', '.') }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Observações se houver divergência -->
                    @if(number_format($venda->value, 2) != number_format($valorCalculado, 2))
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>Atenção:</strong> Há uma divergência entre o valor registrado
                            (R$ {{ number_format($venda->value, 2, ',', '.') }}) e o valor calculado
                            (R$ {{ number_format($valorCalculado, 2, ',', '.') }}).
                        </div>
                    @endif

                    <!-- Botões de ação -->
                    <div class="text-center mt-4">
                        <a href="{{ route('historico.index') }}" class="btn btn-primary">
                            <i class="fas fa-list"></i> Ver Todas as Compras
                        </a>
                        @if(Auth::user()->isAdmin())
                            <button onclick="window.print()" class="btn btn-secondary">
                                <i class="fas fa-print"></i> Imprimir
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('styles')
<style>
    @media print {
        .card-header .btn, .text-center, .btn {
            display: none !important;
        }
    }
</style>
@endsection
@endsection
