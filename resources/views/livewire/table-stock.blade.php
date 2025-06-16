<div class="container">
        <h2 class="text-center mb-5">Controle de Estoque</h2>

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
                            <input type="text" id="describe" name="describe" placeholder="Descrição"
                                class="form-control mb-3">
                            <input type="number" id="price" name="price" placeholder="Valor" class="form-control mb-3"
                                step="0.01">
                            <input type="number" id="amount" name="amount" placeholder="Quantidade"
                                class="form-control mb-3">
                            <select id="type" name="type" class="form-control mb-3">
                                <option value="drink">Bebida</option>
                                <option value="savory">Salgado</option>
                                <option value="lunch">Almoço</option>
                                <option value="snacks">Lanches</option>
                                <option value="natural">Natural</option>
                            </select>
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-edit" class="modal fade" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form id="form-edit" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Editar Produto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" id="edit-name" name="name" placeholder="Nome" class="form-control mb-2"
                                required>
                            <input type="text" id="edit-describe" name="describe" placeholder="Descrição"
                                class="form-control mb-2">
                            <input type="number" id="edit-price" name="price" placeholder="Valor" class="form-control mb-2"
                                step="0.01" required>
                            <input type="number" id="edit-amount" name="amount" placeholder="Quantidade"
                                class="form-control mb-2" required>
                            <select id="edit-type" name="type" class="form-control mb-2" required>
                                <option value="">Selecione... </option>
                                <option value="drink">Bebida</option>
                                <option value="savory">Salgado</option>
                                <option value="lunch">Almoço</option>
                                <option value="snacks">Lanches</option>
                                <option value="natural">Natural</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Salvar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <select id="filter-type" class="form-control my-3 border border-3" onchange="filterByType()">
            <option value="">Filtrar Produtos</option>
            <option value="drink">Bebidas</option>
            <option value="savory">Salgados</option>
            <option value="lunch">Almoço</option>
            <option value="snacks">Lanches</option>
            <option value="natural">Natural</option>
            <option value="">Todos</option>
        </select>

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
                            <button class="btn btn-sm btn-danger" onclick="updateStock({{ $product->id }}, -1)">-</button>
                            <span id="qtd-{{ $product->id }}">{{ $product->amount }}</span>
                            <button class="btn btn-sm btn-success" onclick="updateStock({{ $product->id }}, 1)">+</button>
                        </td>
                        <td>{{ ucfirst($product->tipo_traduzido) }}</td>
                        <td>
                            <input type="number" value="{{ $product->price }}"
                                onchange="updateValue({{ $product->id }}, this.value)">
                        </td>
                        <td>
                            <button class="btn btn-sm btn-warning">Editar</button>
                            <form action="{{ route('estoque.destroy', $product->id) }}" method="POST"
                                style="display:inline-block;" onsubmit="return confirm('Deseja realmente excluir?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button id="btn-add" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-add">Adicionar
            Produto</button>
    </div>