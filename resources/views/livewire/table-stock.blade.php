<div class="container my-5">

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

    <h2 class="text-center mb-4 fw-bold text-primary">Controle de Estoque</h2>

    <div id="modal-add" class="modal fade" tabindex="-1" role="dialog" wire:ignore.self>
        <div class="modal-dialog" role="document">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Adicionar Produto</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>

                        @foreach (['name' => 'Nome', 'describe' => 'Descrição', 'price' => 'Valor', 'amount' => 'Quantidade'] as $field => $label)
                            @error($field)
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="{{ $field === 'price' || $field === 'amount' ? 'number' : 'text' }}"
                                id="{{ $field }}" name="{{ $field }}" placeholder="{{ $label }}"
                                class="form-control mb-3" wire:model="{{ $field }}"
                                {{ $field === 'price' ? 'step=0.01 max=999.99 min=0' : ($field === 'amount' ? 'step=1 max=999 min=0' : 'maxlength=100') }}>
                        @endforeach

                        {{-- Select --}}
                        @error('type')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <select id="type" name="type" class="form-select mb-3" wire:model="type">
                            <option selected value="">Selecione Um Tipo</option>
                            <option value="drink">Bebida</option>
                            <option value="savory">Salgado</option>
                            <option value="lunch">Almoço</option>
                            <option value="snacks">Lanches</option>
                            <option value="natural">Natural</option>
                        </select>

                        <div class="d-grid">
                            <button type="button" class="btn btn-success fw-bold" wire:click="storeProduct">
                                Salvar Produto
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex flex-wrap gap-3 mb-4">
        <input type="text" class="form-control border-primary shadow-sm"
            placeholder="Pesquisar por nome..." wire:model.lazy="filterName"
            style="max-width: 250px;" maxlength="100">

        <select class="form-select border-primary shadow-sm" wire:model.lazy="filterType"
            style="max-width: 220px;">
            <option value="">Filtrar Produtos</option>
            <option value="drink">Bebidas</option>
            <option value="savory">Salgados</option>
            <option value="lunch">Almoço</option>
            <option value="snacks">Lanches</option>
            <option value="natural">Natural</option>
            <option value="">Todos</option>
        </select>
    </div>

    <table class="table table-hover table-bordered align-middle shadow-sm">
        <thead class="table-primary">
            <tr>
                <th class="text-start">Nome</th>
                <th class="text-start">Quantidade</th>
                <th class="text-start">Tipo</th>
                <th class="text-start">Valor (R$)</th>
                <th class="text-start">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td class="fw-semibold text-start">{{ $product->name }}</td>
                        <td class="text-start">
                                <div class="d-flex align-items-center gap-2">
                                    <button class="btn btn-danger btn-sm d-flex align-items-center justify-content-center"
                                        style="width: 38px; height: 38px;"
                                        wire:click="reduceProduct({{ $product->id }})">
                                        −
                                    </button>

                                    <span class="mx-2 fw-bold">{{ $product->amount }}</span>

                                    <button class="btn btn-success btn-sm d-flex align-items-center justify-content-center"
                                        style="width: 38px; height: 38px;"
                                        wire:click="addProduct({{ $product->id }})">
                                        +
                                    </button>
                                </div>
                            </td>
                        <td class="text-start">{{ ucfirst($product->tipo_traduzido) }}</td>
                    <td class="text-start">
                        <div class="border rounded bg-light px-2 py-1 text-end" style="max-width: 100px;">
                            {{ number_format($product->price, 2, ',', '.') }}
                        </div>
                    </td>
                    <td class="text-start">
                        <div class="d-flex align-items-stretch gap-2">
                            <button class="btn btn-warning btn-sm d-flex align-items-center justify-content-center"
                                style="width: 40%; height: 38px;"
                                data-bs-toggle="modal" data-bs-target="#modal-edit{{$loop->index}}">
                                Editar
                            </button>

                            <form action="{{ route('estoque.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Deseja realmente excluir?')"
                                style="width: 40%; height: 38px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="btn btn-danger btn-sm d-flex align-items-center justify-content-center w-100 h-100">
                                    Excluir
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>

                {{-- Modal editar --}}
                <div wire:ignore id="modal-edit{{$loop->index}}" class="modal fade" tabindex="-1">
                    <div class="modal-dialog">
                        <livewire:modal-edit :id="$product->id" />
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>


    <div class="my-3">
        {{ $products->links('vendor.livewire.bootstrap', ['scrollTo' => false]) }}
    </div>

    <div class="text-start">
        <button class="btn btn-primary btn-lg mt-3" data-bs-toggle="modal" data-bs-target="#modal-add">
            + Adicionar Produto
        </button>
    </div>

</div>
