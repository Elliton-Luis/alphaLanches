@extends('layouts.default')

@section('title', 'AlphaLanches - Menu')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/home.js') }}"></script>

    <div class="container mt-4 text-center">
        <h2 class="mb-4">Grade de Painéis</h2>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
<<<<<<< HEAD
            @php
                $buttons = [
                    ['route' => 'financeiro', 'icon' => 'cash-coin', 'label' => 'Financeiro'],
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
=======
        <div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('painelFinanceiro')">
        <i class="fas fa-money-bill-trend-up icon-size"></i>
        <div class="label-size">Financeiro</div>
    </button>
</div>

<div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('estoque')">
        <i class="fas fa-box icon-size"></i>
        <div class="label-size">Estoque</div>
    </button>
</div>

<div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('profile')">
        <i class="fas fa-user icon-size"></i>
        <div class="label-size">Perfil</div>
    </button>
</div>

<div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('painelUsuarios')">
        <i class="fas fa-users icon-size"></i>
        <div class="label-size">Usuários</div>
    </button>
</div>

<div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('painelCompras')">
        <i class="fas fa-basket-shopping icon-size"></i>
        <div class="label-size">Histórico de Compras</div>
    </button>
</div>

<div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('painelPDV')">
        <i class="fas fa-store icon-size"></i>
        <div class="label-size">PDV</div>
    </button>
</div>

<div class="col">
    <button class="btn btn-light square-btn" onclick="redirectTo('sobre')">
        <i class="fas fa-info-circle icon-size"></i>
        <div class="label-size">Sobre Nós</div>
    </button>
</div>


>>>>>>> c5ad58bbeca4a1f9043f6e0404e65b8d181a2c46
        </div>
    </div>
@endsection