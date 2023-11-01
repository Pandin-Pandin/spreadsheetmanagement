<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        
        body {
            position: relative;
            z-index: 1;
        }
        
        .container {
            position: relative;
            width: fit-content  ;
            display: flex;
            flex-direction: column;
            justify-content: center;
            margin-bottom: 20px;
        }
        
        table {
            position: relative;
            background-color: white;
            margin: 10px;
            border: 1px solid black;
            z-index: 1;
        }
        
        th {
            min-width: 100px;
            border: 1px solid black;
        }
        
        th.first-column {
            min-width: 200px;
            border: 1px solid black;
        }
        
        td {
            border: 1px solid black;
            text-align: center;
        }
        
        #screenshot {
            position: sticky;
            left: 10px;
            padding: 10px;
            background-color: rgb(52, 128, 255);
            width: fit-content;
            height: fit-content;
            border-radius: 10px;
            color: white;
            cursor: pointer;
        }
    </style>
    <title>
        <?php
            $table_name = $_GET['table'];
            $sql = "SELECT * FROM " . $table_name;
            echo "Tabela " . $table_name;
        ?>
    </title>
</head>
<body>
    <div class="container">
    <?php
    include "conn.php";
    $conn->set_charset("utf8");
    
    if (isset($_GET['table'])) {
    
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr>';
            // Obter os nomes das colunas e exibi-los como cabeçalhos de tabela
            $row = $result->fetch_assoc();
            $first = true;
            foreach ($row as $columnName => $columnValue) {
                if ($first) {
                    echo '<th class="first-column">' . $columnName . '</th>';
                    $first = false;
                } else {
                    echo '<th>' . $columnName . '</th>';
                }
            }
            echo '</tr>';
    
            $result->data_seek(0); // Voltar ao início dos resultados
    
            // Exibir os valores das colunas em linhas da tabela
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                foreach ($row as $columnValue) {
                    echo '<td>' . $columnValue . '</td>';
                }
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo "Não foram encontrados dados na tabela.";
        }
    } else {
        echo "Nome da tabela não especificado.";
    }
    ?>
    <div id="screenshot">Baixar Tabela</div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#screenshot').click(function() {
                const elementToCapture = $('table')[0]; // Obtenha o elemento DOM
            
                html2canvas(elementToCapture, {
                    scale: 2 // Aumenta a escala para melhor qualidade da imagem (opcional)
                }).then(function(canvas) {
                    // Crie um link <a> para a imagem capturada
                    const a = document.createElement('a');
                    a.href = canvas.toDataURL('image/png');
                    a.download = 'captura_de_tela.png'; // Nome do arquivo de download
            
                    // Clique automaticamente no link para iniciar o download
                    a.click();
                });
            });
        });
    </script>
</body>
</html>