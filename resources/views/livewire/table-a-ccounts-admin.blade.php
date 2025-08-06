<div class="m-3">
    @script
    <script>
        window.addEventListener('closeModal', () => {
            const modals = ['modal-edit-user'];

            modals.forEach(id => {
                const modalEl = document.getElementById(id);
                const instance = bootstrap.Modal.getInstance(modalEl);
                if (instance) instance.hide();
            });

            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            document.body.classList.remove('modal-open');
            document.body.style = '';
        });
    </script>
    @endscript

    @php
        $nomeBotao = auth()->user()->tipo === 'admin' ? '📑 Contas Cadastradas' : '📑 Seus Alunos';
    @endphp

    <div class="accordion" id="accordionTableAccounts">
        <div class="accordion-item border-0 shadow-sm rounded-3 bg-white">
            <h2 class="accordion-header">
                <button class="accordion-button rounded-3 bg-body-tertiary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#tableOne" aria-expanded="true" aria-controls="collapseOne">
                    {{ $nomeBotao }}
                </button>
            </h2>

            <div id="tableOne" class="accordion-collapse collapse show" data-bs-parent="#accordionTableAccounts">
                <div class="accordion-body bg-light rounded-bottom-3 p-4">

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show rounded-2" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-2" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
                        </div>
                    @endif

                    <div class="table-responsive mt-3 bg-white p-3 rounded-3 shadow-sm">

                        <div class="input-group mb-3 gap-2">
                            <input class="form-control border-primary rounded-2 shadow-sm" type="text"
                                wire:model.lazy="filterName" placeholder="Nome" maxlength="100">

                            <input class="form-control border-primary rounded-2 shadow-sm telefone" type="text"
                                wire:model.lazy="filterTelefone" placeholder="Telefone" maxlength="15">

                            <select class="form-select border-primary rounded-2 shadow-sm" wire:model.lazy="filterType">
                                <option value="">Tipo</option>
                                <option value="admin">Administrador</option>
                                <option value="func">Funcionário</option>
                                <option value="guard">Responsável</option>
                                <option value="student">Aluno</option>
                            </select>
                        </div>

                        <!-- Tabela -->
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-primary">
                                <tr class="text-center">
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Tipo</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="text-center">
                                        <td class="fw-semibold">{{ $user->name }}</td>

                                        <td>
                                            {{ $user->telefone ?? 'Sem telefone' }}
                                        </td>

                                        <td>{{ $user->tipo_traduzido }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn btn-outline-primary btn-sm rounded-2 px-3"
                                                    wire:click="editUser({{ $user->id }})" data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit-user">
                                                    Editar
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm rounded-2 px-3"
                                                    onclick="if (confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.')) @this.call('deleteUser', {{ $user->id }})">
                                                    Excluir
                                                </button>
                                            </div>
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

    <div id="modal-edit-user" class="modal fade" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog">
            <form wire:submit.prevent="updateUser" class="modal-content border-0 rounded-3 shadow-sm">
                <div class="modal-header bg-body-tertiary border-0">
                    <h5 class="modal-title">Editar Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body bg-light">
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input wire:model="editName" type="text" class="form-control rounded-2" required
                            maxlength="100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Telefone</label>
                        <input wire:model="editTelefone" type="text" class="form-control rounded-2 telefone"
                            maxlength="15">
                    </div>

                    @auth
                        @if(auth()->user()->type === 'admin')
                            <div class="mb-3">
                                <label class="form-label">Tipo</label>
                                <select wire:model="editType" class="form-select rounded-2" required>
                                    <option value="">Selecione</option>
                                    <option value="admin">Administrador</option>
                                    <option value="func">Funcionário</option>
                                    <option value="guard">Responsável</option>
                                </select>
                            </div>
                        @endif
                    @endauth
                </div>
                <div class="modal-footer bg-body-tertiary border-0">
                    <button type="button" class="btn btn-secondary rounded-2" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary rounded-2 px-4">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/inputmask.min.js"></script>
    <script>
        function applyMasks() {
            document.querySelectorAll('.telefone').forEach(input => {
                Inputmask({
                    mask: '(99) 99999-9999',
                    clearIncomplete: true,
                    showMaskOnHover: false,
                    showMaskOnFocus: true,
                }).mask(input);
            });
        }

        document.addEventListener('DOMContentLoaded', applyMasks);

        document.addEventListener('livewire:load', () => {
            Livewire.hook('message.processed', applyMasks);
        });
    </script>
@endpush