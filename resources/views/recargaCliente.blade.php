@extends('layouts.default')

@section('title', 'AlphaLanches - Recarga')

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>    
</head>

@section('content')
    <livewire:table-a-recharge-client/>
@endsection
