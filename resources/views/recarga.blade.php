@extends('layouts.default')

@section('title', 'AlphaLanches - Recarga')

@section('content')
<div class="container mt-4">
    <h2 class="text-center mb-5">Recarga de Créditos</h2>

    <div class="table-responsive rounded-3 shadow-sm bg-body-tertiary p-2">
        <table class="table table-hover mb-0 border rounded-3 overflow-hidden">
            <thead class="bg-body text-secondary">
                <tr class="text-center">
                    <th scope="col">Nome</th>
                    <th scope="col">Créditos</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="text-center align-middle">
                    <td>{{ $user->name }}</td>
                    <td class="fw-semibold text-success">R$ {{ number_format($user->credit, 2, ',', '.') }}</td>
                    <td>{{ ucfirst($user->type) }}</td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary shadow-sm rounded-2 w-100 w-sm-auto mb-1 mb-sm-0 btn-abrir-modal"
                            data-id="{{ $user->id }}" data-name="{{ $user->name }}"
                            data-credit="{{ number_format($user->credit, 2, ',', '.') }}">
                            <i class="bi bi-cash-coin"></i> Recarga
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal de Recarga -->
<div class="modal fade" id="modalRecarga" tabindex="-1" aria-labelledby="modalRecargaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow rounded-4">
            <div class="modal-header bg-body-tertiary border-0 rounded-top-4">
                <h5 class="modal-title fw-semibold" id="modalRecargaLabel">
                    Recarga para <span id="modal-nome" class="text-primary"></span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body bg-light">
                <div class="p-4 bg-white rounded-3 shadow-sm border-start border-4 border-primary">
                    <h6 class="text-muted">Saldo Atual:</h6>
                    <p id="saldo-atual" class="fs-5 fw-bold text-success mb-4"></p>

                    <label class="form-label fw-semibold">Valor da Recarga:</label>
                    <div class="input-group mb-3">
                        <span class="input-group-text bg-success text-white fw-bold">R$</span>
                        <input type="text" id="valor" class="form-control text-center bg-body-tertiary border-0 shadow-sm fw-bold" readonly>
                    </div>

                    <div class="d-flex flex-wrap justify-content-center gap-2 p-2 bg-body-tertiary rounded-2">
                        @foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 'C', '.'] as $tecla)
                        <button class="btn btn-outline-secondary shadow-sm flex-fill"
                            style="min-width: 60px; height: 60px; font-size: 1.25rem;"
                            onclick="digitar('{{ $tecla }}')">
                            {{ $tecla }}
                        </button>
                        @endforeach
                    </div>

                    <label class="form-label mt-4 fw-semibold">Método de Pagamento:</label>
                    <div class="row g-2 text-center">
                        <div class="col-12 col-md-4">
                            <button class="btn btn-outline-primary w-100 py-2 shadow-sm"
                                onclick="selecionarPagamento('pix')">
                                <i class="bi bi-qr-code fs-5"></i><br>Pix
                            </button>
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-outline-success w-100 py-2 shadow-sm"
                                onclick="selecionarPagamento('cartao')">
                                <i class="bi bi-credit-card fs-5"></i><br>Cartão
                            </button>
                        </div>
                        <div class="col-12 col-md-4">
                            <button class="btn btn-outline-warning w-100 py-2 shadow-sm"
                                onclick="selecionarPagamento('boleto')">
                                <i class="bi bi-file-earmark-text fs-5"></i><br>Boleto
                            </button>
                        </div>
                    </div>

                    <div id="info-pagamento" class="alert alert-info mt-4 d-none shadow-sm">
                        Método selecionado: <span id="metodo-selecionado" class="fw-bold"></span>
                    </div>

                    <input type="hidden" id="user-id">

                    <button class="btn btn-primary w-100 mt-4 py-2 shadow-lg fw-bold"
                        onclick="realizarRecarga()">
                        Confirmar Recarga
                    </button>
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
