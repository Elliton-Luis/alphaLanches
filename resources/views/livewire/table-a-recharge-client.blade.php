<div class="container mt-4">
    <h2 class="text-center mb-5">Recarga de Créditos</h2>

    <div class="d-flex flex-wrap gap-3 mb-4 justify-content">
        <input type="text" class="form-control border-primary shadow-sm" placeholder="Pesquisar por nome..."
            wire:model.lazy="filterName" style="max-width: 250px;" maxlength="100">

        <button id="btn-reset" class="btn btn-danger" type="button" onclick="location.reload();">
            Resetar
        </button>
    </div>

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
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-edit{{$loop->index}}">
                            Recarga
                        </button>
                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modal-edit-negativo{{$loop->index}}">
                            Retirar
                        </button>
                        <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modalHistorico"
                            onclick="Livewire.emit('abrirHistorico', {{ $user->id }}, '{{ addslashes($user->name) }}')">
                            Histórico
                        </button>
                    </td>
                </tr>
                <div wire:ignore id="modal-edit{{$loop->index}}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <livewire:modal-edit-recarga :user-id="$user->id" :nome="$user->name"
                            :saldo-atual="$user->credit" />
                    </div>
                </div>
                <div wire:ignore id="modal-edit-negativo{{$loop->index}}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <livewire:modal-edit-recarga-negativo :user-id="$user->id" :nome="$user->name"
                            :saldo-atual="$user->credit" />
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-4">
        {{ $users->links() }}
    </div>

    <div wire:ignore.self class="modal fade" id="modalHistorico" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <livewire:modal-historico-creditos />
        </div>
    </div>
</div>

<script>
    function abrirHistorico(userId, nome) {
        Livewire.emit('abrirHistorico', userId, nome);
    }
</script>