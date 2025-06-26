<div>
    <form wire:submit.prevent="alterProduct">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Editar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong> {{Session('success')}} </strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div>

                    <div>
                        <input wire:model="name" type="text" placeholder="Nome" class="form-control mb-2" maxlength="100">
                    </div>

                    <div>
                        <input wire:model="describe" type="text" placeholder="Descrição" class="form-control mb-2" maxlength="100">
                    </div>

                    <div>
                        <input wire:model="price" type="number" placeholder="Valor" class="form-control mb-2" step="0.01" max="999.99" min="0">
                    </div>

                    <div>
                        <input wire:model="amount" type="number" placeholder="Quantidade" class="form-control mb-2" step="1" max="999" min="0">
                    </div>

                    <div class="d-flex justify-content-center gap-2">
                        <div class="flex-grow-1">
                            <select class="form-control mb-2" wire:model="type">
                                <option value="">Selecione para alterar...</option>
                                <option value="drink">Bebida</option>
                                <option value="savory">Salgado</option>
                                <option value="lunch">Almoço</option>
                                <option value="snacks">Lanches</option>
                                <option value="natural">Natural</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center w-100 p-1">
                        <button type="submit" class="btn btn-success">Salvar</button>
                    </div>

                </div>
            </div>

        </div>
    </form>
</div>
