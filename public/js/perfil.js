function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const preview = document.getElementById('profilePreview');
        preview.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}

function mascaraCpf(event) {
    var cpf = event.target.value.replace(/\D/g, '');
    if (cpf.length <= 11) {
        cpf = cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
    }
    event.target.value = cpf;
}

function mascaraTelefone(event) {
    var telefone = event.target.value.replace(/\D/g, '');
    if (telefone.length <= 10) {
        telefone = telefone.replace(/(\d{2})(\d{4})(\d{4})/, "($1) $2-$3"); // Para números de 8 dígitos
    } else if (telefone.length <= 11) {
        telefone = telefone.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3"); // Para números de 9 dígitos
    }
    event.target.value = telefone;
}