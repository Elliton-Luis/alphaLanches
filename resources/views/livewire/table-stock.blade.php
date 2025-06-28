<div class="container">
    @script
    <script>
        $wire.on('closeModal', () => {
            let modalElement = document.getElementById('modal-add');
            let modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) modalInstance.hide();
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            document.body.classList.remove('modal-open');
            document.body.style = '';
        });
    </script>
    @endscript

    <h2 class="text-center mb-5">Controle de Estoque</h2>
    <div id="modal-add" class="modal fade" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        @error('name')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        <input type="text" id="name" name="name" placeholder="Nome" class="form-control mb-3"
                            wire:model="name" maxlength="100">
                        @error('describe')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        <input type="text" id="describe" name="describe" placeholder="Descrição"
                            class="form-control mb-3" wire:model="describe" maxlength="100">
                        @error('price')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        <input type="number" id="price" name="price" placeholder="Valor" class="form-control mb-3"
                            wire:model="price" step="0.01" max="999.99" min="0">
                        @error('amount')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        <input type="number" id="amount" name="amount" placeholder="Quantidade"
                            class="form-control mb-3" wire:model="amount" step="1" max="999" min="0">
                        @error('type')
                            <small class="text-danger">{{$message}}</small>
                        @enderror
                        <select id="type" name="type" class="form-control mb-3" wire:model="type">
                            <option selected value="">Selecione Um Tipo</option>
                            <option value="drink">Bebida</option>
                            <option value="savory">Salgado</option>
                            <option value="lunch">Almoço</option>
                            <option value="snacks">Lanches</option>
                            <option value="natural">Natural</option>
                        </select>
                        <button type="button" class="btn btn-outline-success" wire:click="storeProduct"
                            id="saveButtonModal">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-2 my-3">

        <input type="text" class="form-control border border-3 shadow-sm" placeholder="Pesquisar por nome..."
            wire:model.lazy="filterName" style="max-width: 250px; border-color: #0d6efd;" maxlength="100">

        <select id="filter-type" class="form-control border border-3 shadow-sm" wire:model.lazy="filterType"
            style="max-width: 220px; border-color: #0d6efd;">
            <option value="">Filtrar Produtos</option>
            <option value="drink">Bebidas</option>
            <option value="savory">Salgados</option>
            <option value="lunch">Almoço</option>
            <option value="snacks">Lanches</option>
            <option value="natural">Natural</option>
            <option value="">Todos</option>
        </select>

    </div>


    <table class="table table-striped mt-3 border border-3">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Tipo</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody id="product-list">
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <button class="btn btn-danger btn-sm px-3 py-1 fw-bold"
                                wire:click="reduceProduct({{ $product->id}})">−</button>
                            <span id="qtd-{{ $product->id }}" class="mx-2">{{ $product->amount }}</span>
                            <button class="btn btn-success btn-sm px-3 py-1 fw-bold"
                                wire:click="addProduct({{ $product->id}})">+</button>
                        </div>
                    </td>
                    <td>{{ ucfirst($product->tipo_traduzido) }}</td>
                    <td>
                        <input type="text" value="{{ $product->price }}" class="form-control form-control-sm text-end"
                            style="max-width: 120px;" disabled step="0.01" max="999.99" min="0">
                    </td>

                    <td>
                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                            data-bs-target="#modal-edit{{$loop->index}}">Editar</button>
                        <form action="{{ route('estoque.destroy', $product->id) }}" method="POST"
                            style="display:inline-block;" onsubmit="return confirm('Deseja realmente excluir?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                        </form>
                    </td>
                </tr>

                <div wire:ignore id="modal-edit{{$loop->index}}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <livewire:modal-edit :id="$product->id" />
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    {{ $products->links('vendor.livewire.bootstrap', ['scrollTo' => false]) }}

    <button id="btn-add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">Adicionar
        Produto</button>
</div>