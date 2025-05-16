document.getElementById('btn-add').addEventListener('click', function () {
    let modal = new bootstrap.Modal(document.getElementById('modal-add'));
    modal.show();
});


function updateStock(id, change) {
    fetch(`/estoque/update-stock/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ change: change })
    })
        .then(response => response.json())
        .then(data => {
            document.getElementById(`qtd-${id}`).textContent = data.amount;
        });
}

function updateValue(id, price) {
    fetch(`/estoque/update-value/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ price: price })
    })
        .then(response => response.json())
        .then(data => {
            console.log('Preço atualizado:', data.price);
        });
}

function filterByType() {
    let type = document.getElementById('filter-type').value;
    window.location.href = `/estoque?type=${type}`;
}

function openEditModal(id) {
    fetch(`/estoque/edit/${id}`)
        .then(response => response.json())
        .then(product => {
            document.getElementById('edit-name').value = product.name;
            document.getElementById('edit-describe').value = product.describe;
            document.getElementById('edit-price').value = product.price;
            document.getElementById('edit-amount').value = product.amount;
            document.getElementById('edit-type').value = product.type;

            const form = document.getElementById('form-edit');
            form.action = `/estoque/update/${id}`;

            let modal = new bootstrap.Modal(document.getElementById('modal-edit'));
            modal.show();
        });
}