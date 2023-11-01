<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MY STYLES -->
    <link rel="stylesheet" href="css/style.css">
    <title>Tabela</title>
</head>
<body>
    <form id="dataForm">
        <div class="ete">Tabela ETE</div>
        <div class="box-title">Planilha</div>
        <table>
            <tr class="time">
                <th class="head">Parâmetros/Horários</th>
                <?php
                    for ($hora = 0; $hora <24; $hora++) {
                        echo "<th class='head'>" . str_pad($hora, 2, "0", STR_PAD_LEFT) . ":00</th>";
                    }
                ?>
            </tr>
            <?php
                $nomesDasLinhas = [
                    "Vazão Instantânea (m³/h)<br>Captação (ultrassônico)",
                    "Volume Acomulado (m³)<br>Captação (ultrassônico)",
                    "Vazão Instantânea (m³/h)<br>Captação (filtro)",
                    "Vazão Instantânea (m³/h)<br>Estação (ultrassônico)",
                    "Volume Acomulado (m³)<br>Estação (ultrassônico)",
                    "Turbidez NTU<br>(Água Bruta)",
                    "Turbidez NTU<br>(Água Tratada)<br>Filtração Rápida - 0,5 ntu",
                    "Cloro Residual<br>(0,2 a 2,0 mg/L)",
                    "Dosadora (%)",
                    "Lavagem Filtro (min.)",
                    "pH Água Tratada<br>(6,0 a 9,5 UpH)",
                    "Nível Reservatório (%)<br>Nível Crítico (51%)",
                    "Estoque de Hipoclorito",
                    "Temperatura (°C)",
                    "Condições Climáticas"
                ];

                $linha = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15"];
                    foreach ($nomesDasLinhas as $index => $linhaNome) {
                        echo "<tr>
                            <th class='line'>
                                <p class='line-name'>
                                    $linhaNome
                                </p>
                            </th>";
                            for ($coluna = 0; $coluna < 24; $coluna++) {
                                echo "<td>
                                    <input class='line-[$linha[$index]] column-[$coluna]' type='text' name='celula[$linha[$index]][$coluna]'>
                                </td>";
                            }
                        echo "</tr>";
                    }
            ?>
        </table>
        <div class="buttons">
            <input class="send" type="button" id="submitData" value="Enviar Dados">
            <input class="clear" type="button" id="clearData" value="Limpar Campos">
        </div>
        <div class="error-box">
            <div id="error">
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>