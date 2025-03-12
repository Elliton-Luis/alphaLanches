@extends('layouts.default')

@section('title', 'AlphaLanches - Menu')

<!--Link para trazer os ícones-->
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"> 
</head>

@section('content')
    <div class="container mt-4 text-center">
        <h2 class="mb-4">Grade de Painéis</h2>

        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            @php
                $buttons = [
                    ['route' => 'painelFinanceiro', 'icon' => 'money-bill-trend-up', 'label' => 'Financeiro'],
                    ['route' => 'painelEstoque', 'icon' => 'box', 'label' => 'Estoque'],
                    ['route' => 'painelPerfil', 'icon' => 'user', 'label' => 'Perfil'],
                    ['route' => 'painelUsuarios', 'icon' => 'users', 'label' => 'Usuários'],
                    ['route' => 'painelCompras', 'icon' => 'basket-shopping', 'label' => 'Histórico de Compras'],
                    ['route' => 'painelPDV', 'icon' => 'store', 'label' => 'PDV'],
                    ['route' => 'sobre', 'icon' => 'info-circle', 'label' => 'Sobre Nós'],
                ];
            @endphp

            @foreach ($buttons as $btn)
                <div class="col">
                    <button class="btn btn-light square-btn" onclick="redirectTo('{{ $btn['route'] }}')">
                        <i class="fas fa-{{ $btn['icon'] }} icon-size"></i>
                        <div class="label-size">{{ $btn['label'] }}</div>
                    </button>
                </div>
            @endforeach

        </div>
    </div>

    <script>
        function redirectTo(route) {
            window.location.href = "{{ url('/') }}/" + route;
        }
    </script>

    <style>
        .square-btn {
            width: 175px;
            height: 175px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            font-weight: bold;
            box-shadow: 2px 10px 10px rgba(0, 0, 0, 0.2);
        }

        .square-btn:hover {
            background-color: #4ab3ce;
        }

        .icon-size {
            font-size: 2.5rem;
        }

        .label-size {
            font-size: 1.2rem;
            font-weight: bold;
            margin-top: 5px;
        }
    </style>
@endsection
