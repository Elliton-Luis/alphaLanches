@extends('layouts.default')

@section('title', 'AlphaLanches - PDV')

@section('content')

    <script src="{{ asset('js/pdv.js') }}"></script>

    <livewire:pdv/>
@endsection