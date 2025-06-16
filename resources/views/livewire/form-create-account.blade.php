<div class="w-100 w-md-50 m-2">
    <div class="accordion" id="accordionForm">
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#formOne"
                    aria-expanded="true" aria-controls="collapseOne">
                    Criar Conta
                </button>
            </h2>
            <div id="formOne" class="accordion-collapse collapse show" data-bs-parent="#accordionForm">
                <div class="accordion-body">

                    @if(session('errorStoreAccount'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('errorStoreAccount') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('successStoreAccount'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('successStoreAccount') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form wire:submit.prevent="storeAccount">
                        <div class="d-flex flex-wrap justify-content-around">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome*</label>
                                <input wire:model="name" type="text" class="form-control" id="name" name="name"
                                    placeholder="Ex: Fulano de Tal" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email*</label>
                                <input wire:model="email" type="email" class="form-control" id="email" name="email"
                                    placeholder="Ex: email@mail.com" required>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap justify-content-around">
                            <div class="mb-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input wire:model="telefone" type="text" class="form-control" id="telefone"
                                    name="telefone" placeholder="Apenas números" maxlength="16">
                                <script>
                                    jQuery(function ($) {
                                        $("#telefone").mask("(99) 99999-9999");
                                    });
                                </script>
                            </div>
                            <div class="mb-3">
                                <label for="cpf" class="form-label">CPF</label>
                                <input wire:model="cpf" type="text" class="form-control" id="cpf" name="cpf"
                                    placeholder="Apenas números">
                                <script>
                                    jQuery(function ($) {
                                        $("#cpf").mask("999.999.999-99");
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-2">
                            <div class="w-75">
                                <label for="type" class="form-label">Tipo de conta*</label>
                                <select wire:model="type" id="type" name="type" class="form-select" required>
                                    <option value="">Selecione um tipo</option>
                                    <option value="admin">Administrador</option>
                                    <option value="func">Funcionário</option>
                                    <option value="guard">Responsável</option>
                                </select>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
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