@extends('layouts.default')

@section('title', 'AlphaLanches - Recarga')

@section('content')
    <script src="{{ asset('js/recarga.js') }}"></script>

    <div class="container mt-4">
        <h2 class="text-center">Recarga de Créditos</h2>

        <div class="card p-4 shadow-sm mt-4">
            <h5>Saldo Atual: <span id="saldo-atual" class="fw-bold text-success">R$ {{ number_format(auth()->user()->creditos, 2, ',', '.') }}</span></h5>

            <label class="form-label mt-3">Valor da Recarga:</label>
            <div class="input-group p-2 rounded">
                <span class="input-group-text bg-success text-white">R$</span>
                <input type="text" id="valor" class="form-control text-center border-0" style="background-color: rgb(199, 248, 203); font-weight: bold;" readonly>
            </div>            

            <!-- Teclado Digital -->
            <div class="d-flex flex-wrap justify-content-center mt-3" style="max-width: 250px; margin: auto;">
                @foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 'C', '.'] as $tecla)
                    <button class="btn btn-secondary m-1" style="width: 60px; height: 60px;" onclick="digitar('{{ $tecla }}')">
                        {{ $tecla }}
                    </button>
                @endforeach
            </div>

            <label class="form-label mt-3">Escolha um método de pagamento:</label>
            <div class="d-flex justify-content-around">
                <button class="btn btn-outline-primary" onclick="selecionarPagamento('pix')">
                    <i class="bi bi-qr-code"></i> Pix
                </button>
                <button class="btn btn-outline-success" onclick="selecionarPagamento('cartao')">
                    <i class="bi bi-credit-card"></i> Cartão de Crédito
                </button>
                <button class="btn btn-outline-warning" onclick="selecionarPagamento('boleto')">
                    <i class="bi bi-file-earmark-text"></i> Boleto
                </button>
            </div>

            <div id="info-pagamento" class="alert alert-info mt-3 d-none">
                Método selecionado: <span id="metodo-selecionado" class="fw-bold"></span>
            </div>

            <button class="btn btn-primary w-100 mt-3" onclick="realizarRecarga()">Confirmar Recarga</button>
        </div>
    </div>
@endsection