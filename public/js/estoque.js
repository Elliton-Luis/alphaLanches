document.getElementById('btn-add').addEventListener('click', function () {
    let modal = new bootstrap.Modal(document.getElementById('modal-add'));
    modal.show();
});


function updateStock(id, change) {
    fetch(`/estoque/update-stock/${id}`, {
        method: 'POST',
        headers: {'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}'},
        body: JSON.stringify({ change: change })
    }).then(response => response.json())
      .then(data => {
          document.getElementById(`qtd-${id}`).innerText = data.amount;
      });
}

function updateValue(id, newValue) {
    fetch(`/estoque/update-value/${id}`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ price: newValue })
    });
}

function filterByType() {
    let type = document.getElementById('filter-type').value;
    window.location.href = `/estoque?type=${type}`;
}