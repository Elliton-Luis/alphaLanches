@extends('layouts.default')

@section('title', 'AlphaLanches - Estoque')

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@section('content')

    <script src="{{ asset('js/estoque.js') }}"></script>

    <livewire:table-stock/>

@endsection