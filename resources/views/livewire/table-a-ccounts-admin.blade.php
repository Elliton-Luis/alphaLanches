<div class="m-2"">
    <div class=" accordion" id="accordionTableAccounts">
    <div class="accordion-item">
        <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#tableOne"
                aria-expanded="true" aria-controls="collapseOne">
                Contas Cadastradas
            </button>
        </h2>
        <div id="tableOne" class="accordion-collapse collapse show" data-bs-parent="#accordionTableAccounts">
            <div class="accordion-body" style="width: 625px;">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="table-responsive mt-4">

                    <div class="input-group mb-2">
                        <input class="form-control border-primary" type="text" wire:model.lazy="filterName"
                            placeholder="Nome" maxlength="100">
                        <input class="form-control border-primary" type="text" wire:model.lazy="filterTelefone"
                            placeholder="Telefone" id="filterTelefone" maxlength="15" oninput="maskTelefone(this)">
                        <select class="form-select border-primary" wire:model.lazy="filterType">
                            <option value="">Selecione um Tipo</option>
                            <option value="admin">Administrador</option>
                            <option value="func">Funcionário</option>
                            <option value="guard">Responsavel</option>
                            <option value="student">Aluno</option>
                        </select>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr class="text-center">
                                    <td>{{ $user->name }}</td>

                                    @if(!$user->telefone)
                                        <td>Sem telefone cadastrado</td>
                                    @else
                                        <td>{{ $user->telefone }}</td>
                                    @endif

                                    <td>{{ $user->tipo_traduzido }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-warning"
                                            wire:click="editUser({{ $user->id }})">Editar</button>
                                        <button class="btn btn-sm btn-danger"
                                            wire:click="deleteUser({{ $user->id }})">Excluir</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $users->links('vendor.livewire.bootstrap') }}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true"
    wire:ignore.self>
    <div class="modal-dialog">
        <form wire:submit.prevent="updateUser" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editUserModalLabel">Editar Usuário</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input wire:model="editName" type="text" class="form-control" id="name" maxlength="100" required>
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input wire:model="editTelefone" type="text" class="form-control" id="telefone" oninput="maskTelefone(this)" maxlength="15" required>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Tipo</label>
                    <select wire:model="editType" class="form-select" id="type" required>
                        <option value="">Selecione</option>
                        <option value="admin">Administrador</option>
                        <option value="func">Funcionário</option>
                        <option value="guard">Responsável</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            </div>
        </form>
    </div>
</div>
</div>

<script>
function maskTelefone(input) {
    let value = input.value.replace(/\D/g, '');

    if (value.length > 11) value = value.slice(0, 11);

    if (value.length === 0) {
        input.value = '';
    } else if (value.length <= 2) {
        input.value = `(${value}`;
    } else if (value.length <= 6) {
        input.value = `(${value.slice(0, 2)}) ${value.slice(2)}`;
    } else if (value.length <= 10) {
        input.value = `(${value.slice(0, 2)}) ${value.slice(2, 6)}-${value.slice(6)}`;
    } else {
        input.value = `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7)}`;
    }
}
</script>


@push('scripts')
    <script>
        window.addEventListener('showEditModal', () => {
            const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
            modal.show();
        });

        window.addEventListener('hideEditModal', () => {
            const modalEl = document.getElementById('editUserModal');
            const modal = bootstrap.Modal.getInstance(modalEl);
            if (modal) {
                modal.hide();
            }
        });
    </script>
@endpush