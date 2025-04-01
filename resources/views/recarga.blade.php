@extends('layouts.default')

@section('title', 'AlphaLanches - Recarga')

@section('content')
    <script src="{{ asset('js/recarga.js') }}"></script>

    <div class="container mt-4">
        <h2 class="text-center">Recarga de Créditos</h2>

        <div class="card p-4 shadow-sm mt-4">
            <h5>Saldo Atual: <span id="saldo-atual" class="fw-bold text-success">R$ {{ number_format(auth()->user()->creditos, 2, ',', '.') }}</span></h5>

            <label class="form-label mt-3">Valor da Recarga:</label>
            <div class="input-group">
                <span class="input-group-text">R$</span>
                <input type="text" id="valor" class="form-control text-center" readonly>
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

    <script>
        function digitar(tecla) {
            let input = document.getElementById("valor");
            if (tecla === 'C') {
                input.value = ''; // Limpar campo
            } else if (tecla === '.' && input.value.includes('.')) {
                return; // Evita múltiplos pontos decimais
            } else {
                input.value += tecla;
            }
        }

        function selecionarPagamento(metodo) {
            let nomeMetodo = {
                pix: 'Pix',
                cartao: 'Cartão de Crédito',
                boleto: 'Boleto'
            };

            document.getElementById("metodo-selecionado").innerText = nomeMetodo[metodo];
            document.getElementById("info-pagamento").classList.remove("d-none");
        }

        function realizarRecarga() {
            let valor = parseFloat(document.getElementById("valor").value);
            let metodo = document.getElementById("metodo-selecionado").innerText;

            if (!valor || valor <= 0) {
                alert("Digite um valor válido para a recarga.");
                return;
            }

            if (!metodo) {
                alert("Escolha um método de pagamento.");
                return;
            }

            fetch("{{ route('recarga.process') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ valor: valor, metodo: metodo })
            })
            .then(response => response.json())
            .then(data => {
                if (data.sucesso) {
                    document.getElementById("saldo-atual").innerText = `R$ ${data.novo_saldo.toFixed(2).replace('.', ',')}`;
                    document.getElementById("valor").value = "";
                    alert("Recarga realizada com sucesso!");
                } else {
                    alert("Erro ao processar recarga.");
                }
            })
            .catch(error => console.error("Erro:", error));
        }
    </script>
@endsection