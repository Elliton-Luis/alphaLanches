@extends('layouts.default')

@section('title', 'Pedidos Reservados')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Pedidos Reservados (Em Espera)</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($reservas as $reserva)
        <div class="border rounded p-3 mb-4 shadow-sm">
            <p><strong>Cliente:</strong> {{ $reserva->user->name }}</p>
            <p><strong>Data Agendada:</strong> {{ \Carbon\Carbon::parse($reserva->scheduled_date)->format('d/m/Y') }}</p>
            <p><strong>Total:</strong> R$ {{ number_format($reserva->value, 2, ',', '.') }}</p>

            <p><strong>Itens Reservados:</strong></p>
            <ul class="list-group mb-3">
                @foreach($reserva->reservedProducts as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $item->product->name }}
                        <span class="badge bg-primary rounded-pill">Qtd: {{ $item->quantity }}</span>
                    </li>
                @endforeach
            </ul>

            <form method="POST" action="{{ route('pedidosReservados.concluir', $reserva->id) }}">
                @csrf
                @method('PATCH')
                <button class="btn btn-success">Dar Baixa</button>
            </form>
        </div>
    @empty
        <p class="text-muted">Não há reservas pendentes.</p>
    @endforelse
</div>
@endsection