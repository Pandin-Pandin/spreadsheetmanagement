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
                <th class="empty">Coluna 1</th>
                <?php
                    for ($hora = 0; $hora <24; $hora++) {
                        echo "<th class='head'>" . str_pad($hora, 2, "0", STR_PAD_LEFT) . ":00</th>";
                    }
                ?>
            </tr>
            <?php
                for ($linha = 1; $linha <= 10; $linha++) {
                    echo "<tr>
                        <th class='line'>
                            <p>
                                Linha-$linha
                            </p>
                        </th>";
                        for ($coluna = 0; $coluna < 24; $coluna++) {
                            echo "<td>
                                <input class='line-[$linha] column-[$coluna]' type='text' name='celula[$linha][$coluna]'>
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