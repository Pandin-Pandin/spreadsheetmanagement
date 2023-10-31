<?php
    include "conn.php";
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
        // Função de ordenação personalizada para organizar por data
        function sortByDate($a, $b) {
            $dateA = explode("_", $a);
            $dateB = explode("_", $b);
            $timestampA = mktime(0, 0, 0, $dateA[1], $dateA[0], $dateA[2]);
            $timestampB = mktime(0, 0, 0, $dateB[1], $dateB[0], $dateB[2]);
            return $timestampB - $timestampA;
        }

        // Ordenar as tabelas pelo nome (data) em ordem decrescente
        uksort($tables, 'sortByDate');
        // Exibir as tabelas na ordem desejada

        foreach ($tables as $tableName) {
            echo '<div class="links">
                <a class="link" href="download.php?table=' . $tableName . ' " target="_blank">' . $tableName . '</a>                        
                <span class="material-symbols-outlined view-table" data-table="' . $tableName . '">
                    visibility
                </span>
            </div>
            <br>';
        }
    } else {
        echo "<p style='height: 40px; width: 100%; color: white; background-color: var(--blue-bg-two);display: flex; justify-content: center; align-items: center;'>Nenhuma tabela encontrada no banco de dados.</p>";
    }
    // Fecha a conexão com o banco de dados
    $conn->close();
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/script.js"></script>