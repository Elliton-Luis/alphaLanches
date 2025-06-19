<div class="w-100 w-md-50 m-2">
    <div class="accordion" id="accordionForm">
        <div class="accordion-item border-0 shadow-sm rounded-3 bg-white">
            <h2 class="accordion-header">
                <button class="accordion-button rounded-3 bg-body-tertiary" type="button"
                        data-bs-toggle="collapse" data-bs-target="#formOne"
                        aria-expanded="true" aria-controls="collapseOne">
                    ✏️ Criar Conta
                </button>
            </h2>

            <div id="formOne" class="accordion-collapse collapse show" data-bs-parent="#accordionForm">
                <div class="accordion-body bg-white rounded-bottom-3">

                    @if(session('errorStoreAccount'))
                        <div class="alert alert-danger alert-dismissible fade show rounded-2 mt-3" role="alert">
                            {{ session('errorStoreAccount') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('successStoreAccount'))
                        <div class="alert alert-success alert-dismissible fade show rounded-2 mt-3" role="alert">
                            {{ session('successStoreAccount') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="p-4 bg-light rounded-3 shadow-sm">
                        <form wire:submit.prevent="storeAccount">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label for="name" class="form-label text-secondary fw-semibold small">Nome*</label>
                                    <input wire:model="name" type="text"
                                        class="form-control rounded-2 shadow-sm"
                                        id="name" placeholder="Ex: Lucas Gabriel" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="email" class="form-label text-secondary fw-semibold small">Email*</label>
                                    <input wire:model="email" type="email"
                                        class="form-control rounded-2 shadow-sm"
                                        id="email" placeholder="Ex: email@mail.com" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="telefone" class="form-label text-secondary fw-semibold small">Telefone</label>
                                    <input wire:model="telefone" type="text"
                                        class="form-control rounded-2 shadow-sm"
                                        id="telefone" placeholder="(99) 99999-9999" maxlength="16">
                                </div>

                                <div class="col-md-6">
                                    <label for="cpf" class="form-label text-secondary fw-semibold small">CPF</label>
                                    <input wire:model="cpf" type="text"
                                        class="form-control rounded-2 shadow-sm"
                                        id="cpf" placeholder="999.999.999-99">
                                </div>

                                <div class="col-12">
                                    <label for="type" class="form-label text-secondary fw-semibold small">Tipo de conta*</label>
                                    <select wire:model="type" id="type"
                                        class="form-select rounded-2 shadow-sm" required>
                                        <option value="">Selecione um tipo</option>
                                        <option value="admin">Administrador</option>
                                        <option value="func">Funcionário</option>
                                        <option value="guard">Responsável</option>
                                    </select>
                                </div>

                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary rounded-2 px-4 shadow-sm">
                                    Cadastrar
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

<script>
    function aplicarMascaras() {
        $('#telefone').mask('(99) 99999-9999');
        $('#cpf').mask('999.999.999-99');
    }

    document.addEventListener('livewire:load', aplicarMascaras);
    Livewire.hook('message.processed', aplicarMascaras);
</script>
@endpush