@extends('layouts.default')

@section('title', 'AlphaLanches - Menu')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/home.js') }}"></script>

    <div class="container mt-4 text-center">
        <h2 class="mb-4">Grade de Painéis</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            @if (auth()->user()->type == 'Admin')
            {{
                $buttons = [
                    ['route' => 'financeiro', 'icon' => 'cash-coin', 'label' => 'Financeiro'],
                    ['route' => 'estoque', 'icon' => 'box', 'label' => 'Estoque'],
                    ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                    ['route' => 'painelUsuarios', 'icon' => 'people', 'label' => 'Usuários'],
                    ['route' => 'painelCompras', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                    ['route' => 'painelPDV', 'icon' => 'shop', 'label' => 'PDV'],
                    ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                    ];
            }}
            @elseif (auth()->user()->type == 'Func')
            {{
                $buttons = [
                    ['route' => 'estoque', 'icon' => 'box', 'label' => 'Estoque'],
                    ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                    ['route' => 'painelCompras', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                    ['route' => 'painelPDV', 'icon' => 'shop', 'label' => 'PDV'],
                    ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                    ];
            }}

            @elseif (auth()->user()->type == 'Guard')
            {{
                $buttons = [
                    ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                    ['route' => 'recarga', 'icon' => 'wallet', 'label' => 'Recarga'],
                    ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                ];
            }}

            @elseif (auth()->user()->type == 'Student')
            {{
                $buttons = [
                    ['route' => 'profile', 'icon' => 'person', 'label' => 'Perfil'],
                    ['route' => 'recarga', 'icon' => 'wallet', 'label' => 'Recarga'],
                    ['route' => 'PainelHistorico', 'icon' => 'basket3', 'label' => 'Histórico de Compras'],
                    ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                ];
            }}
            @endif
            @foreach ($buttons as $button)
            <div class="col">
            <button class="btn btn-light square-btn" data-route="{{ url($button['route']) }}" onclick="redirectTo(this)">
                <i class="bi bi-{{ $button['icon'] }} icon-size"></i>
                <div class="label-size">{{ $button['label'] }}</div>
            </button>                    
        </div>
        @endforeach
        </div>
    </div>
@endsection