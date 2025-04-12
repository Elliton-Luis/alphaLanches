<div class="w-100 w-md-50 m-2">
    <div class="accordion" id="accordionTableAccounts">

        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#tableOne" aria-expanded="true" aria-controls="collapseOne">
                Contas Cadastradas
            </button>
          </h2>
          <div id="tableOne" class="accordion-collapse collapse show" data-bs-parent="#accordionTableAccounts">
            <div class="accordion-body">
                <div class="table-responsive mt-4">

                    <div class="input-group mb-2">
                        <input class="form-control border-primary" type="text" wire:model.lazy="name" placeholder="Nome">
                        <input class="form-control border-primary" type="text" wire:model.lazy="telefone" placeholder="Telefone">
                        <select class="form-select border-primary" wire:model.lazy="type">
                            <option value="">Selecione um Tipo</option>
                            <option value="admin">Administrador</option>
                            <option value="func">Funcionário</option>
                            <option value="guard">Responsavel</option>
                            <option value="student">Aluno</option>
                        </select>
                    </div>

                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr class="text-center">
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr class="text-center">
                                <td>{{ $user->name }}</td>

                                @if(!$user->telefone)
                                <td>Sem telefone cadastrado</td>
                                @else
                                <td>{{ $user->telefone }}</td>
                                @endif

                                <td>{{ $user->type }}</td>
                                <td>
                                    <button class="btn btn-sm btn-warning">Editar</button>
                                    <button wire:click='deleteUser({{$user->id}})' class="btn btn-sm btn-danger">Excluir</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$users->links('vendor.livewire.bootstrap') }}
                </div>
            </div>
          </div>
        </div>

    </div>
</div>
