<div class="modal-content border-0 shadow-lg rounded-4 p-3">
    <div class="modal-header border-0">
        <h5 class="modal-title">
            Histórico de Créditos - <span class="text-primary">{{ $nome }}</span>
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
        <div class="card shadow-lg border-0 p-4">
            @if (empty($historico) || count($historico) === 0)
                <div class="alert alert-warning text-center fw-bold">
                    Nenhum registro de crédito encontrado.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Data</th>
                                <th>Tipo</th>
                                <th>Valor</th>
                                <th>Método</th>
                                <th>Executado por</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($historico as $registro)
                                <tr>
                                    <td>{{ $registro->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        @if ($registro->tipo === 'entrada')
                                            <span class="text-success">
                                                <i class="bi bi-arrow-down-circle"></i> Recarga
                                            </span>
                                        @else
                                            <span class="text-danger">
                                                <i class="bi bi-arrow-up-circle"></i> Retirada
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        R$ {{ number_format($registro->valor, 2, ',', '.') }}
                                    </td>
                                    <td>
                                        <span class="badge bg-secondary text-uppercase">
                                            {{ $registro->metodo_pagamento }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $registro->executor->name ?? 'Desconhecido' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>