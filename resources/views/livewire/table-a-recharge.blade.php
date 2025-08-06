<div class="container mt-4">
    <h2 class="text-center mb-5">Recarga de Créditos</h2>
    <div class="input-group mb-3 gap-2">
        <input type="text" class="form-control border-primary shadow-sm" placeholder="Pesquisar por nome..."
            wire:model.lazy="filterName" style="max-width: 250px;" maxlength="100">

        <select class="form-select border-primary rounded-2 shadow-sm" wire:model.lazy="filterType">
            <option value="">Tipo</option>
            <option value="admin">Administrador</option>
            <option value="func">Funcionário</option>
            <option value="guard">Responsável</option>
            <option value="student">Aluno</option>
        </select>

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
</div>