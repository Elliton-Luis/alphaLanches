<div>
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form wire:submit.prevent="realizarRetirada">
            <div class="modal-content border-0 shadow-lg rounded-4 p-3">
                <div class="modal-header border-0">
                    <h5 class="modal-title">
                        Retirar de <span class="text-primary">{{ $nome }}</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    @error('valor')
                        <div class="text-danger fw-bold mt-2">{{ $message }}</div>
                    @enderror

                    @error('user')
                        <div class="text-danger fw-bold mt-2">{{ $message }}</div>
                    @enderror

                    <div class="card p-4 shadow-lg border-0">
                        <h5 class="text-secondary">Saldo Atual:
                            <span class="fw-bold text-danger">R$ {{ number_format($saldoAtual, 2, ',', '.') }}</span>
                        </h5>

                        <label class="form-label mt-3 fw-bold">Valor da Retirada:</label>
                        <div class="input-group p-2 rounded shadow-sm">
                            <span class="input-group-text bg-danger text-white fw-bold">R$</span>
                            <input type="text" class="form-control text-center border-0"
                                style="background-color: rgb(248, 199, 199); font-weight: bold;" readonly
                                wire:model="valor">
                        </div>

                        <div class="d-flex flex-wrap justify-content-center mt-4">
                            @foreach ([1, 2, 3, 4, 5, 6, 7, 8, 9, 0, 'C', '.'] as $tecla)
                                <button type="button" class="btn btn-secondary m-1 flex-grow-1 shadow-sm"
                                    style="width: 60px; height: 60px; font-size: 1.2rem;"
                                    wire:click="digitar('{{ $tecla }}')">
                                    {{ $tecla }}
                                </button>
                            @endforeach
                        </div>

                        <br>

                        <div class="d-flex justify-content-center w-100 p-1">
                            <button type="submit" class="btn btn-danger">Confirmar Retirada de Crédito</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>