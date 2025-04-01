function digitar(tecla) {
    let input = document.getElementById("valor");
    if (tecla === 'C') {
        input.value = ''; // Limpar campo
    } else if (tecla === '.' && input.value.includes('.')) {
        return; // Evita múltiplos pontos decimais
    } else {
        input.value += tecla;
    }
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

    fetch("{{ route('recarga.process') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({ valor: valor, metodo: metodo })
    })
    .then(response => response.json())
    .then(data => {
        if (data.sucesso) {
            document.getElementById("saldo-atual").innerText = `R$ ${data.novo_saldo.toFixed(2).replace('.', ',')}`;
            document.getElementById("valor").value = "";
            alert("Recarga realizada com sucesso!");
        } else {
            alert("Erro ao processar recarga.");
        }
    })
    .catch(error => console.error("Erro:", error));
}