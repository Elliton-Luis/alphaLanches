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
                        <!-- Informações da compra -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <h5>Informações Gerais</h5>
                                <p><strong>Data:</strong> {{ $venda->created_at->format('d/m/Y') }}</p>
                                @if(Auth::user()->isAdmin())
                                    <p><strong>Cliente:</strong> {{ $venda->user->name }}</p>
                                @endif
                                <p><strong>Valor Total:</strong>
                                    <span class="badge badge-success fs-6 text-success">
                                        R$ {{ number_format($venda->total, 2, ',', '.') }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h5>Resumo da Compra</h5>
                                <p><strong>Quantidade de Itens:</strong> {{ $venda->items->sum('quantity') }}</p>
                                <p><strong>Tipos de Produtos:</strong> {{ $venda->items->count() }}</p>
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
                                    @foreach($venda->items as $item)
                                        @php
                                            $preco = $item->unit_price;
                                            $subtotal = $item->quantity * $preco;
                                            $valorCalculado += $subtotal;
                                        @endphp
                                        <tr>
                                            <td>
                                                <strong>{{ $item->product->name ?? 'Produto removido' }}</strong>
                                                @if($item->product && $item->product->descricao)
                                                    <br><small class="text-muted">{{ $item->product->descricao }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="badge badge-info text-dark">
                                                    {{ $item->product->tipo_traduzido ?? '---' }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary text-dark">
                                                    {{ $item->quantity }}
                                                </span>
                                            </td>
                                            <td>
                                                R$ {{ number_format($preco, 2, ',', '.') }}
                                            </td>
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('styles')
        <style>
            @media print {

                .card-header .btn,
                .text-center,
                .btn {
                    display: none !important;
                }
            }
        </style>
    @endsection
@endsection