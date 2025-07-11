@extends('layouts.default')

@section('title', 'Pedidos Reservados')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Pedidos Reservados (Em Espera)</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($reservas as $reserva)
        <div class="border rounded p-3 mb-3">
            <p><strong>Cliente ID:</strong> {{ $reserva->customer_id }}</p>
            <p><strong>Data Agendada:</strong> {{ $reserva->scheduled_date }}</p>
            <p><strong>Total:</strong> R$ {{ number_format($reserva->value, 2, ',', '.') }}</p>

            <form method="POST" action="{{ route('pedidosReservados.concluir', $reserva->id) }}">
                @csrf
                @method('PATCH')
                <button class="btn btn-success">Dar Baixa</button>
            </form>
        </div>
    @empty
        <p>Não há reservas pendentes.</p>
    @endforelse
</div>
@endsection