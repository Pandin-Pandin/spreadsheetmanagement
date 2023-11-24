<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <canvas id="meuGrafico" style="width:400px; height:300px;"></canvas>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Os dados coletados no seu código PHP
        var dados = {
            labels: ["ETE1", "ETE2", "ETE3"],
            datasets: [{
                label: "pH afluente",
                data: [7.5, 8.0, 7.2],
                backgroundColor: ["red", "green", "blue"]
            }]
        };

        // Configurar o elemento de gráfico
        var ctx = document.getElementById("meuGrafico").getContext("2d");

        // Criar o gráfico de barras
        var meuGrafico = new Chart(ctx, {
            type: "bar",
            data: dados,
            options: {
                responsive: false
            }
        });
    </script>
</body>
</html>