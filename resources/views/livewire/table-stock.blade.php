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

    <h2 class="text-center my-5 fw-bold">Controle de Estoque</h2>

    <div class="d-flex flex-wrap gap-3 mb-4 justify-content-center">
        <input type="text" class="form-control border-primary shadow-sm" placeholder="Pesquisar por nome..."
            wire:model.lazy="filterName" style="max-width: 250px;" maxlength="100">

        <select class="form-control border-primary shadow-sm" wire:model.lazy="filterType" style="max-width: 220px;">
            <option value="">Filtrar Produtos</option>
            <option value="drink">Bebidas</option>
            <option value="savory">Salgados</option>
            <option value="lunch">Almoço</option>
            <option value="snacks">Lanches</option>
            <option value="natural">Natural</option>
            <option value="">Todos</option>
        </select>

        <button id="btn-add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">
            Adicionar Produto
        </button>

        <button id="btn-reset" class="btn btn-danger" type="button" onclick="location.reload();">
            Resetar
        </button>
    </div>

    <div class="table-responsive rounded-3 shadow-sm">
        <table class="table table-striped border border-3 align-middle text-center">
            <thead class="table-primary">
                <tr>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Tipo</th>
                    <th>Valor (R$)</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="product-list">
                @foreach($products as $product)
                    <tr>
                        <td class="fw-semibold">{{ $product->name }}</td>
                        <td>
                            <div class="d-flex align-items-center justify-content-center gap-2">
                                <button class="btn btn-danger btn-sm fw-bold px-3 py-1"
                                    wire:click="reduceProduct({{ $product->id }})">−</button>
                                <span id="qtd-{{ $product->id }}" class="mx-2">{{ $product->amount }}</span>
                                <button class="btn btn-success btn-sm fw-bold px-3 py-1"
                                    wire:click="addProduct({{ $product->id }})">+</button>
                            </div>
                        </td>
                        <td>{{ ucfirst($product->tipo_traduzido) }}</td>
                        <td>
                            <span class="fw-semibold">R$ {{ number_format($product->price, 2, ',', '.') }}</span>
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <button class="btn btn-warning fw-semibold py-2"
                                    style="width: 100px;"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modal-edit{{$loop->index}}">Editar</button>

                                <form action="{{ route('estoque.destroy', $product->id) }}" method="POST"
                                    onsubmit="return confirm('Deseja realmente excluir?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger fw-semibold py-2"
                                        style="width: 100px;">Excluir</button>
                                </form>
                            </div>
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
    </div>

    {{ $products->links('vendor.livewire.bootstrap', ['scrollTo' => false]) }}

    <div id="modal-add" class="modal fade" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content shadow-sm">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Adicionar Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div>
                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                        <input type="text" name="name" placeholder="Nome" class="form-control mb-3"
                            wire:model="name" maxlength="100">

                        @error('describe') <small class="text-danger">{{ $message }}</small> @enderror
                        <input type="text" name="describe" placeholder="Descrição" class="form-control mb-3"
                            wire:model="describe" maxlength="100">

                        @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                        <input type="number" name="price" placeholder="Valor" class="form-control mb-3"
                            wire:model="price" step="0.01" max="999.99" min="0">

                        @error('amount') <small class="text-danger">{{ $message }}</small> @enderror
                        <input type="number" name="amount" placeholder="Quantidade" class="form-control mb-3"
                            wire:model="amount" step="1" max="999" min="0">

                        @error('type') <small class="text-danger">{{ $message }}</small> @enderror
                        <select name="type" class="form-control mb-3" wire:model="type">
                            <option value="">Selecione um Tipo</option>
                            <option value="drink">Bebida</option>
                            <option value="savory">Salgado</option>
                            <option value="lunch">Almoço</option>
                            <option value="snacks">Lanches</option>
                            <option value="natural">Natural</option>
                        </select>

                        @error('image_url') <small class="text-danger">{{ $message }}</small> @enderror

                        <button type="button" class="btn btn-success w-100 fw-semibold"
                            wire:click="storeProduct">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
