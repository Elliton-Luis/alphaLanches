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