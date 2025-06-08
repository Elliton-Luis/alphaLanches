@extends('layouts.default')

@section('title', 'AlphaLanches - Recarga')

@section('content')
    <div class="container mt-4">
        <h2 class="text-center mb-5">Recarga de Créditos</h2>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col">Nome</th>
                    <th scope="col">Créditos</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="text-center">
                        <td>{{ $user->name }}</td>

                        <td>R$ {{number_format($user->credit, 2, ',', '.') }}</td>

                        <td>{{ $user->tipo_traduzido }}</td>
                        
                        <td>
                            <button class="btn btn-sm btn-primary btn-abrir-modal" data-id="{{ $user->id }}"
                                data-name="{{ $user->name }}" data-credit="{{ number_format($user->credit, 2, ',', '.') }}">
                                Recarga
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal de Recarga -->
    <div class="modal fade" id="modalRecarga" tabindex="-1" aria-labelledby="modalRecargaLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title" id="modalRecargaLabel">Recarga para <span id="modal-nome"
                            class="text-primary"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="card p-4 shadow-lg border-0">
                        <h5 class="text-secondary">Saldo Atual:
                            <span id="saldo-atual" class="fw-bold text-success"></span>
                        </h5>

                        <label class="form-label mt-3 fw-bold">Valor da Recarga:</label>
                        <div class="input-group p-2 rounded shadow-sm">
                            <span class="input-group-text bg-success text-white fw-bold">R$</span>
                            <input type="text" id="valor" class="form-control text-center border-0"
                                style="background-color: rgb(199, 248, 203); font-weight: bold;" readonly>
                        </div>

                        <div class="d-flex flex-wrap justify-content-center mt-4">
                            @foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 'C', '.'] as $tecla)
                                <button class="btn btn-secondary m-1 flex-grow-1 shadow-sm"
                                    style="width: 60px; height: 60px; font-size: 1.2rem;" onclick="digitar('{{ $tecla }}')">
                                    {{ $tecla }}
                                </button>
                            @endforeach
                        </div>

                        <label class="form-label mt-4 fw-bold">Escolha um método de pagamento:</label>
                        <div class="row text-center g-3">
                            <div class="col-12 col-md-4">
                                <button class="btn btn-outline-primary w-100 shadow-sm py-2"
                                    onclick="selecionarPagamento('pix')">
                                    <i class="bi bi-qr-code fs-4"></i><br>Pix
                                </button>
                            </div>
                            <div class="col-12 col-md-4">
                                <button class="btn btn-outline-success w-100 shadow-sm py-2"
                                    onclick="selecionarPagamento('cartao')">
                                    <i class="bi bi-credit-card fs-4"></i><br>Cartão de Crédito
                                </button>
                            </div>
                            <div class="col-12 col-md-4">
                                <button class="btn btn-outline-warning w-100 shadow-sm py-2"
                                    onclick="selecionarPagamento('boleto')">
                                    <i class="bi bi-file-earmark-text fs-4"></i><br>Boleto
                                </button>
                            </div>
                        </div>

                        <div id="info-pagamento" class="alert alert-info mt-4 d-none shadow-sm">
                            Método selecionado: <span id="metodo-selecionado" class="fw-bold"></span>
                        </div>

                        <input type="hidden" id="user-id">
                        <button class="btn btn-primary w-100 mt-4 py-2 shadow-lg fw-bold"
                            onclick="realizarRecarga()">Confirmar Recarga</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var RECARGA_PROCESS_URL = "{{ route('recarga.process') }}";
        var CSRF_TOKEN = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/recarga.js') }}"></script>
@endsection