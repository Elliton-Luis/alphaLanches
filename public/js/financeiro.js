document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("graficoReceitasDespesas");
    
    if (ctx) {
        ctx = ctx.getContext("2d");
        
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun"],
                datasets: [{
                    label: "Receitas", 
                    data: [5000, 7000, 6000, 8000, 7500, 9000],
                    backgroundColor: "#28a745"
                }, {
                    label: "Despesas",
                    data: [3000, 4000, 3500, 5000, 4500, 6000],
                    backgroundColor: "#dc3545"
                }]
            },
            options: {
                responsive: true, 
                scales: {
                    y: {
                        beginAtZero: true 
                    }
                }
            }
        });
    } else {
        console.error("Elemento canvas não encontrado.");
    }
});
