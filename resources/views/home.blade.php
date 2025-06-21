@extends('layouts.default')

@section('title', 'AlphaLanches - Menu')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container mt-4 text-center">
        <h1 class="mb-4">Grade de Painéis</h1>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach ($buttons as $button)
                <div class="col">
                    <a
                        class="btn btn-light d-flex flex-column justify-content-center align-items-center p-4 border rounded-4 shadow-sm w-100 h-100"
                        style="aspect-ratio: 1 / 1; transition: all 0.3s ease;"
                        href="{{ url($button['route']) }}"
                        onclick="redirectTo(this)"
                        onmouseover="this.classList.add('shadow-lg')"
                        onmouseout="this.classList.remove('shadow-lg')">
                        <i class="bi bi-{{ $button['icon'] }} fs-1 mb-2"></i>
                        <div class="fw-semibold fs-5">{{ $button['label'] }}</div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
