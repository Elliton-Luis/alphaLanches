document.addEventListener("DOMContentLoaded", function () {
    var ctx = document.getElementById("graficoReceitasDespesas");
    
    if (ctx) {
        ctx = ctx.getContext("2d");
        
        new Chart(ctx, {
            type: "bar",
            data: {
                labels: window.vendasMesesLabels || [],
                datasets: [{
                    label: "Receita", 
                    data: window.vendasMesesData || [],
                    backgroundColor: "#ecab0f"
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
