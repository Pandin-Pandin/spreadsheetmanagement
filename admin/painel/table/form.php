<?php
    // Conexão com o banco de dados (substitua com suas próprias credenciais)
    $servername = "";
    $dbUsername = "";
    $dbPassword = "";
    $dbName = "";

    try {
        // Tentar criar a conexão com o banco de dados
        $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
    } catch (mysqli_sql_exception $e) {
        echo "Erro ao conectar ao banco de dados. Por favor, tente novamente mais tarde.";
        // Ou qualquer outra mensagem de erro que você considere apropriada
        exit; // Terminar o script, já que não é possível prosseguir sem a conexão
    }

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }
    
    $conn->set_charset("utf8");
    
    // Consulta SQL para listar informações sobre as tabelas
    $sql = "SHOW TABLE STATUS";
    $result = $conn->query($sql);
    
    $tables = array();
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $tableName = $row["Name"];
            $tableRows = $row["Rows"];
    
            // Verifique se a tabela possui algum dado
            if ($tableRows > 0) {
                $tables[$tableName] = $tableName;
            }
        }

        // Ordenar as tabelas pelo nome (data) em ordem decrescente
        uksort($tables, 'sortByDate');
        // Exibir as tabelas na ordem desejada
        $row = $result->fetch_assoc();
        echo '<div class="form-data">';
        foreach ($tables as $date) {
            echo '<div class="table-name">
                    ' . $date . '<span class="arrow bottom"></span>
                </div>';

            $sqlData = "SELECT * FROM $date";
            $resultData = $conn->query($sqlData);
            if ($resultData->num_rows > 0) {
                echo '<table class="data-form disable">';
                echo '<tr>';
                
                // Cabeçalhos da tabela
                $row = $resultData->fetch_assoc();
                $columnName = ["ETE",
                "Horário da análise",
                "pH afluente",
                "pH tanque de aeração", 
                "OD", 
                "Sedimentabilidade lodo tanque de aeração", 
                "PH efluente", 
                "Vazão calha Parshall"];
                echo '<script>
                    var columnName = ' . json_encode($columnName) . ';
                </script>';
                foreach ($columnName as $key) {
                    echo '<th>' . $key . '</th>';
                }
                echo '</tr>';
                
                // Dados da tabela
                do {
                    echo '<tr>';
                    foreach ($row as $key => $value) {
                        echo '<td>' . $value . '</td>';
                    }
                    echo '</tr>';
                } while ($row = $resultData->fetch_assoc());
                
                echo '</table>';
            } else {
                echo "Nenhum dado encontrado para a tabela $date";
            }
        }
        echo '</div>';
    } else {
        echo "<p style='height: 40px; width: 100%; color: white; background-color: var(--blue-bg-two);display: flex; justify-content: center; align-items: center;'>Nenhuma tabela encontrada no banco de dados.</p>";
    }
    // Fecha a conexão com o banco de dados
    $conn->close();
?>