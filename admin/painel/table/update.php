<?php

            include "conn.php";

            // Consulta SQL para listar informações sobre as tabelas
            $sql = "SHOW TABLE STATUS";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $tableName = $row["Name"];
                    $tableRows = $row["Rows"];
                    
                    // Verifique se a tabela possui algum dado
                    if ($tableRows > 0) {
                        echo '<a class="link" href="download.php?table=' . $tableName . ' " target="_blank">' . $tableName . '</a><br>';
                    }
                }
            } else {
                echo "Nenhuma tabela encontrada no banco de dados.";
            }

            // Fecha a conexão com o banco de dados
            $conn->close();
?>