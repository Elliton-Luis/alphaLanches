<!-- 📱 Formulário de Cadastro de Conta Responsivo -->
<div class="container-fluid px-2">
  <div class="accordion mb-3" id="accordionForm">
    <div class="accordion-item border-0 shadow-sm rounded-3 bg-white">
      <h2 class="accordion-header">
        <button class="accordion-button rounded-3 bg-body-tertiary" type="button" data-bs-toggle="collapse" data-bs-target="#formOne" aria-expanded="true">
          ✏️ Criar Conta
        </button>
      </h2>
      <div id="formOne" class="accordion-collapse collapse show">
        <div class="accordion-body bg-white rounded-bottom-3">
          @if(session('errorStoreAccount'))
            <div class="alert alert-danger alert-dismissible fade show rounded-2 mt-3">
              {{ session('errorStoreAccount') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif
          @if(session('successStoreAccount'))
            <div class="alert alert-success alert-dismissible fade show rounded-2 mt-3">
              {{ session('successStoreAccount') }}
              <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
          @endif
          <div class="p-3 bg-light rounded-3 shadow-sm">
            <form wire:submit.prevent="storeAccount">
              <div class="row g-3">
                <div class="col-12">
                  <label class="form-label">Nome*</label>
                  <input wire:model="name" type="text" class="form-control rounded-2 shadow-sm" placeholder="Ex: Fulano de Tal" required maxlength="100">
                </div>
                <div class="col-12">
                  <label class="form-label">Email*</label>
                  <input wire:model="email" type="email" class="form-control rounded-2 shadow-sm" placeholder="Ex: email@mail.com" required maxlength="254">
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label">Telefone</label>
                  <input wire:model="telefone" type="text" class="form-control rounded-2 shadow-sm" placeholder="(99) 99999-9999" maxlength="15">
                </div>
                <div class="col-12 col-md-6">
                  <label class="form-label">CPF</label>
                  <input wire:model="cpf" type="text" class="form-control rounded-2 shadow-sm" placeholder="999.999.999-99" maxlength="14">
                </div>
              </div>
              <div class="d-flex justify-content-end mt-3">
                <button type="submit" class="btn btn-primary rounded-2 px-4 shadow-sm">Cadastrar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/inputmask/5.0.8/inputmask.min.js"></script>

@push('scripts')
    <script>
        function formatCPF(value) {
            return value
                .replace(/\D/g, '')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d)/, '$1.$2')
                .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        }

        function formatTelefone(value) {
            value = value.replace(/\D/g, '');

            if (value.length === 0) return '';

            if (value.length <= 2) {
                return `(${value}`;
            } else if (value.length <= 7) {
                return `(${value.slice(0, 2)}) ${value.slice(2)}`;
            } else if (value.length <= 11) {
                return `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7)}`;
            } else {
                return `(${value.slice(0, 2)}) ${value.slice(2, 7)}-${value.slice(7, 11)}`;
            }
        }

        function applyMasks() {
            const cpfInput = document.getElementById('cpf');
            const telefoneInput = document.getElementById('telefone');

            if (cpfInput) {
                cpfInput.value = formatCPF(cpfInput.value);
                cpfInput.addEventListener('input', function () {
                    this.value = formatCPF(this.value);
                });
            }

            if (telefoneInput) {
                telefoneInput.value = formatTelefone(telefoneInput.value);

                telefoneInput.addEventListener('input', function () {
                    const pos = this.selectionStart;
                    const oldLength = this.value.length;

                    const formatted = formatTelefone(this.value);
                    this.value = formatted;

                    const newLength = this.value.length;
                    const diff = newLength - oldLength;
                    this.setSelectionRange(pos + diff, pos + diff);
                });
            }
        }

        document.addEventListener('DOMContentLoaded', applyMasks);

        document.addEventListener('livewire:load', function () {
            Livewire.hook('message.processed', () => {
                applyMasks();
            });
        });
    </script>
@endpush