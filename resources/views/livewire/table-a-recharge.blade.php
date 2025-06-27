<div class="container mt-4">
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

    <h2 class="text-center mb-5">Recarga de Créditos</h2>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr class="text-center">
                <th>Nome</th>
                <th>Créditos</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr class="text-center">
                    <td>{{ $user->name }}</td>
                    <td>R$ {{ number_format($user->credit, 2, ',', '.') }}</td>
                    <td>{{ $user->tipo_traduzido }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                            data-bs-target="#modal-edit{{$loop->index}}">
                            Recarga
                        </button>
                    </td>
                </tr>
                <div wire:ignore id="modal-edit{{$loop->index}}" class="modal fade" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <livewire:modal-edit-recarga :user-id="$user->id" :nome="$user->name"
                            :saldo-atual="$user->credit" />
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
</div>