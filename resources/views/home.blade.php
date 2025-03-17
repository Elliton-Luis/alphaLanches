@extends('layouts.default')

@section('title', 'AlphaLanches - Menu')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/home.js') }}"></script>

    <div class="container mt-4 text-center">
        <h2 class="mb-4">Grade de Painéis</h2>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            @php
                $buttons = [
                    ['route' => 'painelFinanceiro', 'icon' => 'cash-coin', 'label' => 'Financeiro'],
                    ['route' => 'estoque', 'icon' => 'box', 'label' => 'Estoque'],
                    ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                    ['route' => 'painelUsuarios', 'icon' => 'people', 'label' => 'Usuários'],
                    ['route' => 'painelCompras', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                    ['route' => 'painelPDV', 'icon' => 'shop', 'label' => 'PDV'],
                    ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                ];
            @endphp

            @foreach ($buttons as $btn)
                <div class="col">
                    <button class="btn btn-light square-btn" data-route="{{ url($btn['route']) }}" onclick="redirectTo(this)">
                        <i class="bi bi-{{ $btn['icon'] }} icon-size"></i>
                        <div class="label-size">{{ $btn['label'] }}</div>
                    </button>                    
                </div>
            @endforeach
        </div>
    </div>
@endsection