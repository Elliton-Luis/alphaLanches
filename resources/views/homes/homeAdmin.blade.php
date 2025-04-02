@extends('layouts.default')

@section('title', 'AlphaLanches - Menu')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/home.js') }}"></script>

    <div class="container mt-4 text-center">
        <h2 class="mb-4">Grade de Painéis</h2>

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

        @include('components.buttons', ['buttons' => $buttons])
    </div>
@endsection