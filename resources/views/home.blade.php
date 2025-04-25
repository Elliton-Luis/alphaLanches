@extends('layouts.default')

@section('title', 'AlphaLanches - Menu')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/home.js') }}"></script>

    <div class="container mt-4 text-center">
        <h1 class="mb-4">Grade de Painéis</h1>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
            @foreach ($buttons as $button)
                <div class="col">
                    <button class="btn btn-light square-btn w-100" data-route="{{ url($button['route']) }}" onclick="redirectTo(this)">
                        <i class="bi bi-{{ $button['icon'] }} icon-size"></i>
                        <div class="label-size">{{ $button['label'] }}</div>
                    </button>
                </div>
            @endforeach
        </div>
    </div>
@endsection
