@extends('layouts.default')

@section('title', 'AlphaLanches - Menu')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <script src="{{ asset('js/home.js') }}"></script>

    <div class="container mt-4 text-center">
        <h2 class="mb-4">Grade de Painéis</h2>
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-3">
            {{$buttons}}
        </div>
        @if (auth()->user()->type == 'admin' || auth()->user()->type == 'guard')
            
        @endif
    </div>
@endsection