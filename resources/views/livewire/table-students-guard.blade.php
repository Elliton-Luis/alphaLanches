<div class="m-3">
    @script
    <script>
        window.addEventListener('closeModal', () => {
            const modals = ['modal-edit-student'];

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

    <style>
        @media (max-width: 767.98px) {
            .input-group input.form-control {
                font-size: 1.1rem;
            }

            .lista-alunos-pequena {
                display: flex;
                justify-content: space-between;
                align-items: center;
                border-bottom: 1px solid #dee2e6;
                padding: 0.5rem 0;
            }

            .lista-alunos-pequena .nome-aluno {
                flex-grow: 1;
                text-align: center;
                overflow-wrap: break-word;
                margin-right: 1rem;
                font-weight: 600;
                cursor: pointer;
                color: #000; /* preto */
                background: transparent;
                border: 1px solid #ced4da; /* outline clara */
                padding: 0.25rem 0.5rem;
                border-radius: 0.25rem;
                font-size: 1rem;
                transition: background-color 0.2s ease;
            }

            .lista-alunos-pequena .nome-aluno:hover,
            .lista-alunos-pequena .nome-aluno:focus {
                background-color: #e9ecef; /* leve hover */
                outline: none;
            }

            .modal-footer .btn-outline-danger {
                display: inline-block;
            }
        }

        @media (min-width: 768px) {
            .modal-footer .btn-outline-danger {
                display: none !important;
            }
        }
    </style>

    <div class="accordion" id="accordionTableAccounts">
        <div class="accordion-item border-0 shadow-sm rounded-3 bg-white">
            <h2 class="accordion-header">
                <button class="accordion-button rounded-3 bg-body-tertiary" type="button" data-bs-toggle="collapse"
                    data-bs-target="#tableOne" aria-expanded="true" aria-controls="collapseOne">
                    📑 Seus Alunos
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

                    <div class="input-group mb-3 gap-2">
                        <input class="form-control border-primary rounded-2 shadow-sm" type="text"
                            wire:model.lazy="filterName" placeholder="Nome" maxlength="100">

                        <input class="form-control border-primary rounded-2 shadow-sm telefone" type="text"
                            wire:model.lazy="filterTelefone" placeholder="Telefone" maxlength="15">
                    </div>

                    <!-- Tabela para md+ -->
                    <div class="table-responsive d-none d-md-block mt-3 bg-white p-3 rounded-3 shadow-sm">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>Nome</th>
                                    <th>Telefone</th>
                                    <th>Email</th>
                                    <th>CPF</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="fw-semibold text-start">{{ $user->name }}</td>
                                        <td>{{ $user->telefone ?? 'Sem telefone' }}</td>
                                        <td>{{ $user->email ?? 'Sem Email' }}</td>
                                        <td>{{ $user->cpf ?? 'Sem CPF' }}</td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn btn-outline-primary btn-sm rounded-2 px-3"
                                                    wire:click="editUser({{ $user->id }})" data-bs-toggle="modal"
                                                    data-bs-target="#modal-edit-student">
                                                    Editar
                                                </button>
                                                <button class="btn btn-outline-danger btn-sm rounded-2 px-3"
                                                    onclick="if(confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.')) @this.call('deleteUser', {{ $user->id }})">
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

                    <!-- Lista simplificada para sm- -->
                    <div class="d-block d-md-none mt-3 bg-white p-3 rounded-3 shadow-sm">
                        @foreach ($users as $user)
                            <div class="lista-alunos-pequena">
                                <button class="nome-aluno"
                                    wire:click="editUser({{ $user->id }})" data-bs-toggle="modal"
                                    data-bs-target="#modal-edit-student"
                                    type="button"
                                    >
                                    {{ $user->name }}
                                </button>
                            </div>
                        @endforeach
                        {{ $users->links('vendor.livewire.bootstrap') }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-edit-student" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true"
        wire:ignore.self>
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
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input wire:model="editEmail" type="email" class="form-control rounded-2 telefone"
                            maxlength="15">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CPF</label>
                        <input wire:model="editCPF" type="text" class="form-control rounded-2 telefone"
                            maxlength="15">
                    </div>
                </div>
                <div class="modal-footer bg-body-tertiary border-0 d-flex justify-content-between">
                    <button type="button" class="btn btn-secondary rounded-2" data-bs-dismiss="modal">Cancelar</button>

                    <!-- Botão excluir só visível em telas pequenas -->
                    <button
                        type="button"
                        class="btn btn-outline-danger rounded-2 d-md-none"
                        onclick="if(confirm('Tem certeza que deseja excluir sua conta? Esta ação não pode ser desfeita.')) @this.call('deleteUser', {{ $selectedUserId ?? 'null' }})"
                        data-bs-dismiss="modal"
                    >
                        Excluir
                    </button>

                    <button type="submit" class="btn btn-primary rounded-2 px-4">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function formatTelefone(value) {
        value = value.replace(/\D/g, '');

        if (value.length === 0) return '';

        if (value.length <= 2) {
            return `(${value}`;
        } else if (value.length <= 7) {
            return `(${value.slice(0, 2)}) ${value.slice(2)}`;
        } else if (value.length <= 11) {
            return `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7)}`;
        } else {
            return `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7, 11)}`;
        }
    }

    function applyMasks() {
        const telefoneInputs = document.querySelectorAll('.telefone');

        telefoneInputs.forEach(input => {
            input.value = formatTelefone(input.value);

            input.addEventListener('input', function () {
                const pos = this.selectionStart;
                const oldLength = this.value.length;

                const formatted = formatTelefone(this.value);
                this.value = formatted;

                const newLength = this.value.length;
                const diff = newLength - oldLength;
                this.setSelectionRange(pos + diff, pos + diff);
            });
        });
    }

    document.addEventListener('DOMContentLoaded', applyMasks);

    document.addEventListener('livewire:load', function () {
        Livewire.hook('message.processed', () => {
            applyMasks();
        });
    });
</script>
@endpush
