<div>
    <script src="{{ asset('js/estoque.js') }}"></script>

    <div class="container-fluid px-3 px-md-5 mt-4">
        <h2 class="text-center mb-4 fw-bold">Controle de Estoque</h2>

        <div class="d-flex justify-content-between align-items-center mb-3 gap-2">
            <button id="btn-add" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modal-add">Adicionar Produto</button>
            <input type="text" placeholder="Buscar produto..." class="form-control w-50 w-md-50 my-2 my-md-0" wire:model.lazy="filterName">

            <select class="w-50 form-select my-3" wire:model.lazy="filterType">
                <option value="">Todos</option>
                <option value="bebida">Bebidas</option>
                <option value="salgado">Salgados</option>
                <option value="almoço">Almoço</option>
                <option value="lanche">Lanches</option>
                <option value="natural">Natural</option>
            </select>
        </div>

        <div class="table-responsive">
            <table class="table table-striped mt-3">
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
                                <button class="btn btn-sm btn-danger px-3 mx-3" onclick="updateStock({{ $product->id }}, -1)">-</button>
                                <span id="qtd-{{ $product->id }}">{{ $product->amount }}</span>
                                <button class="btn btn-sm btn-success px-3 mx-3" onclick="updateStock({{ $product->id }}, 1)">+</button>
                            </td>
                            <td>{{ ucfirst($product->type) }}</td>
                            <td>
                                <input type="number" value="{{ $product->price }}" class="form-control"
                                    onchange="updateValue({{ $product->id }}, this.value)">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{$products->links('vendor.livewire.bootstrap')}}
        </div>
    </div>

    <div id="modal-add" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Adicionar Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="form-add" method="POST" action="{{ route('estoque.store') }}">
                        @csrf
                        <input type="text" id="name" name="name" placeholder="Nome" class="form-control mb-3">
                        <input type="text" id="describe" name="describe" placeholder="Descrição" class="form-control mb-3">
                        <input type="number" id="price" name="price" placeholder="Valor" class="form-control mb-3" step="0.01">
                        <input type="number" id="amount" name="amount" placeholder="Quantidade" class="form-control mb-3">
                        <select id="type" name="type" class="form-select mb-3">
                            <option value="drink">Bebida</option>
                            <option value="savory">Salgado</option>
                            <option value="lunch">Almoço</option>
                            <option value="snacks">Lanches</option>
                            <option value="natural">Natural</option>
                        </select>
                        <button type="submit" class="btn btn-success w-100">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>