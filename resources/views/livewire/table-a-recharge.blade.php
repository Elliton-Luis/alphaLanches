<div class="container mt-4">
    <h2 class="text-center mb-5">Recarga de Créditos</h2>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr class="text-center">
                <th>Nome</th>
                <th>Créditos</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="text-center">
                    <td>{{ $user->name }}</td>
                    <td>R$ {{ number_format($user->credit, 2, ',', '.') }}</td>
                    <td>{{ $user->tipo_traduzido }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" wire:click="abrirModal({{ $user->id }}, '{{ $user->name }}', {{ $user->credit }})">
                            Recarga
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div wire:ignore.self class="modal fade" id="modalRecarga" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4 p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        Recarga para <span class="text-primary">{{ $nome }}</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="card p-4 shadow-lg border-0">
                        <h5 class="text-secondary">Saldo Atual:
                            <span class="fw-bold text-success">R$ {{ number_format($saldoAtual, 2, ',', '.') }}</span>
                        </h5>

                        <label class="form-label mt-3 fw-bold">Valor da Recarga:</label>
                        <div class="input-group p-2 rounded shadow-sm">
                            <span class="input-group-text bg-success text-white fw-bold">R$</span>
                            <input type="text" class="form-control text-center border-0"
                                   style="background-color: rgb(199, 248, 203); font-weight: bold;"
                                   value="{{ $valor }}" readonly>
                        </div>

                        <div class="d-flex flex-wrap justify-content-center mt-4">
                            @foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 'C', '.'] as $tecla)
                                <button wire:click="digitar('{{ $tecla }}')"
                                        class="btn btn-secondary m-1 flex-grow-1 shadow-sm"
                                        style="width: 60px; height: 60px; font-size: 1.2rem;">
                                    {{ $tecla }}
                                </button>
                            @endforeach
                        </div>

                        <label class="form-label mt-4 fw-bold">Escolha um método de pagamento:</label>
                        <div class="row text-center g-3">
                            <div class="col-12 col-md-4">
                                <button wire:click="selecionarPagamento('pix')" class="btn btn-outline-primary w-100 shadow-sm py-2">
                                    <i class="bi bi-qr-code fs-4"></i><br>Pix
                                </button>
                            </div>
                            <div class="col-12 col-md-4">
                                <button wire:click="selecionarPagamento('cartao')" class="btn btn-outline-success w-100 shadow-sm py-2">
                                    <i class="bi bi-credit-card fs-4"></i><br>Cartão de Crédito
                                </button>
                            </div>
                            <div class="col-12 col-md-4">
                                <button wire:click="selecionarPagamento('boleto')" class="btn btn-outline-warning w-100 shadow-sm py-2">
                                    <i class="bi bi-file-earmark-text fs-4"></i><br>Boleto
                                </button>
                            </div>
                        </div>

                        @if ($mostrarInfo)
                            <div class="alert alert-info mt-4 shadow-sm">
                                Método selecionado: <span class="fw-bold">{{ ucfirst($metodo) }}</span>
                            </div>
                        @endif

                        <button class="btn btn-primary w-100 mt-4 py-2 shadow-lg fw-bold"
                                wire:click="realizarRecarga">
                            Confirmar Recarga
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    window.addEventListener('abrirModalRecarga', () => {
        new bootstrap.Modal(document.getElementById('modalRecarga')).show();
    });

    window.addEventListener('fecharModalRecarga', () => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('modalRecarga'));
        modal.hide();
    });
</script>
@endpush