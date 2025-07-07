<div class="modal-content p-3">
    <div class="modal-header">
        <h5 class="modal-title">Histórico de Créditos</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>

    <div class="modal-body">
        @if ($creditsLogs->isEmpty())
            <div class="alert alert-warning">Nenhum registro encontrado.</div>
        @else
            <table class="table table-bordered table-hover">
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
                    @foreach ($creditsLogs as $log)
                        <tr>
                            <td>{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <span class="badge {{ $log->tipo === 'entrada' ? 'bg-success' : 'bg-danger' }}">
                                    {{ ucfirst($log->tipo) }}
                                </span>
                            </td>
                            <td>R$ {{ number_format($log->valor, 2, ',', '.') }}</td>
                            <td>{{ ucfirst($log->metodo_pagamento) }}</td>
                            <td>{{ $log->executor->name ?? 'Sistema' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-3 d-flex justify-content-center">
                {{ $creditsLogs->links() }}
            </div>
        @endif
    </div>
</div>