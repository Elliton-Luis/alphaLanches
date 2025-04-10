@extends('layouts.default')

@section('title', 'AlphaLanches - Recarga')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center text-primary fw-bold">Recarga de Créditos</h2>

        <div class="card p-4 shadow-lg mt-4 border-0">
            <h5 class="text-secondary">Saldo Atual:
                <span id="saldo-atual" class="fw-bold text-success">R$ {{ number_format(auth()->user()->credit, 2, ',', '.') }}</span>
            </h5>

            <label class="form-label mt-3 fw-bold">Valor da Recarga:</label>
            <div class="input-group p-2 rounded shadow-sm">
                <span class="input-group-text bg-success text-white fw-bold">R$</span>
                <input type="text" id="valor" class="form-control text-center border-0"
                    style="background-color: rgb(199, 248, 203); font-weight: bold;" readonly>
            </div>

            <!-- Teclado Digital -->
            <div class="d-flex flex-wrap justify-content-center mt-4">
                @foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 'C', '.'] as $tecla)
                    <button class="btn btn-secondary m-1 flex-grow-1 shadow-sm"
                        style="width: 60px; height: 60px; font-size: 1.2rem;"
                        onclick="digitar('{{ $tecla }}')">
                        {{ $tecla }}
                    </button>
                @endforeach
            </div>

            <label class="form-label mt-4 fw-bold">Escolha um método de pagamento:</label>
            <div class="row text-center g-3">
                <div class="col-12 col-md-4">
                    <button class="btn btn-outline-primary w-100 shadow-sm py-2" onclick="selecionarPagamento('pix')">
                        <i class="bi bi-qr-code fs-4"></i><br>Pix
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <button class="btn btn-outline-success w-100 shadow-sm py-2" onclick="selecionarPagamento('cartao')">
                        <i class="bi bi-credit-card fs-4"></i><br>Cartão de Crédito
                    </button>
                </div>
                <div class="col-12 col-md-4">
                    <button class="btn btn-outline-warning w-100 shadow-sm py-2" onclick="selecionarPagamento('boleto')">
                        <i class="bi bi-file-earmark-text fs-4"></i><br>Boleto
                    </button>
                </div>
            </div>

            <div id="info-pagamento" class="alert alert-info mt-4 d-none shadow-sm">
                Método selecionado: <span id="metodo-selecionado" class="fw-bold"></span>
            </div>

            <button class="btn btn-primary w-100 mt-4 py-2 shadow-lg fw-bold" onclick="realizarRecarga()">Confirmar Recarga</button>
        </div>
    </div>

    <script>
        var RECARGA_PROCESS_URL = "{{ route('recarga.process') }}";
        var CSRF_TOKEN = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/recarga.js') }}"></script>
@endsection
