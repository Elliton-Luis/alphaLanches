let recargaModal;

document.addEventListener('DOMContentLoaded', function () {
    const botaoAbrirModal = document.querySelectorAll('.btn-abrir-modal');

    botaoAbrirModal.forEach(btn => {
        btn.addEventListener('click', function () {
            const userId = this.dataset.id;
            const nome = this.dataset.name;
            const credit = this.dataset.credit;

            document.getElementById('modal-nome').textContent = nome;
            document.getElementById('saldo-atual').textContent = 'R$ ' + credit;
            document.getElementById('user-id').value = userId;
            document.getElementById('valor').value = '';
            document.getElementById('metodo-selecionado').textContent = '';
            document.getElementById('info-pagamento').classList.add('d-none');

            recargaModal = new bootstrap.Modal(document.getElementById('modalRecarga'));
            recargaModal.show();
        });
    });
});

function digitar(tecla) {
    let input = document.getElementById("valor");

    if (tecla === 'C') {
        input.value = '';
        return;
    }

    let valorAtual = input.value;

    if (tecla === '.' && valorAtual.includes('.')) {
        return;
    }

    if (valorAtual.includes('.')) {
        let [inteiro, decimal] = valorAtual.split('.');
        if (decimal.length >= 2) {
            return;
        }
    }

    input.value += tecla;
}


function selecionarPagamento(metodo) {
    let nomeMetodo = {
        pix: 'Pix',
        cartao: 'Cartão de Crédito',
        boleto: 'Boleto'
    };

    document.getElementById("metodo-selecionado").innerText = nomeMetodo[metodo];
    document.getElementById("info-pagamento").classList.remove("d-none");
}

function realizarRecarga() {
    let valor = parseFloat(document.getElementById("valor").value);
    let metodo = document.getElementById("metodo-selecionado").innerText;

    if (!valor || valor <= 0) {
        alert("Digite um valor válido para a recarga.");
        return;
    }

    if (!metodo) {
        alert("Escolha um método de pagamento.");
        return;
    }

    fetch(RECARGA_PROCESS_URL, {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": CSRF_TOKEN
        },
        body: JSON.stringify({
            user_id: document.getElementById('user-id').value,
            valor: valor,
            metodo: metodo
        })
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Erro ${response.status}: ${response.statusText}`);
            }
            return response.json();
        })
        .then(data => {
            console.log("Resposta do servidor:", data);
            if (data.sucesso) {
                document.getElementById("saldo-atual").innerText = `R$ ${data.novo_saldo.toFixed(2).replace('.', ',')}`;
                document.getElementById("valor").value = "";

                recargaModal.hide();

                location.reload();
            }
            else {
                alert("Erro ao processar recarga.");
            }
        })
        .catch(error => console.error("Erro:", error));
}