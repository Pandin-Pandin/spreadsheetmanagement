<?php

$host = 'localhost';
$user = 'pandin';
$password = 'P@nd1n@P';
$database = 'tabledb';
$destiny_database = 'finaltable';

try {
    $conn = new mysqli($host, $user, $password, $database);
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    for ($hour = 0; $hour < 24; $hour++) {
        $hour_str = "`" . str_pad($hour, 2, "0", STR_PAD_LEFT) . ":00`";
        $hours[] = $hour_str;
    }

    $hour_str = implode(", ", $hours);

    for ($maxHour = 0; $maxHour < 24; $maxHour++) {
        $maxHour_str = "MAX(`" . str_pad($maxHour, 2, "0", STR_PAD_LEFT) . ":00`)";
        $maxHour_str .= " AS " . "`" . str_pad($maxHour, 2, "0", STR_PAD_LEFT) . ":00`";
        $maxHours[] = $maxHour_str;
    }

    $maxHour_str = implode(", ", $maxHours);

    $date = date('d_m_y');

    $sqlComplement = "SHOW TABLES LIKE '$date\__%'";

    $linesSQLComplemente = $conn->query($sqlComplement);

    $unionQuery = "";

    if ($linesSQLComplemente->num_rows>0) {

        $firstTable = true;

        while ($row = $linesSQLComplemente->fetch_row()) {
            $tableName = $row[0];

            if (!$firstTable) {
                $unionQuery .= " UNION ";
            } else {
                $firstTable = false;
            }

            $unionQuery .= "SELECT `Parâmetros/Horários`, $hour_str FROM $tableName";
            echo $unionQuery . "\n";
        }
    }
    echo $unionQuery . "\n";
    var_dump($unionQuery);
    
    $sql = "SELECT `Parâmetros/Horários`, $maxHour_str
        FROM ( $unionQuery ) AS merged
        GROUP BY `Parâmetros/Horários`";

    $fileName = '/home/' . $date . '.csv';

    $result = $conn->query($sql);

    if ($result) {

            $newTableName = $date;

            $verifyTableExist = "SHOW TABLES LIKE '" . $newTableName . "'";
            $resultVerify = $conn->query($verifyTableExist);

            if ($resultVerify && $resultVerify->num_rows == 1) {
                $deleteTable = "DROP TABLE " . $newTableName;
                $conn->query($deleteTable);
                echo "Tabela anterior do banco de dados de origem excluída!\n";
            }

            $tableStructure = "CREATE TABLE " . $newTableName . " AS " . $sql;
            $createNewTable = $conn->query($tableStructure);
            
            if ($createNewTable) {
                
                try {
                    
                    $destiny_conn = new mysqli($host, $user, $password, $destiny_database);
                    
                    if ($destiny_conn->connect_error) {
                        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
                    }
                    
                    $destiny_verifyTableExist = "SHOW TABLES LIKE '" . $newTableName . "'";
                    
                    $destiny_resultVerify = $destiny_conn->query($destiny_verifyTableExist);
                    
                    if ($destiny_verifyTableExist && $destiny_resultVerify->num_rows == 1) {
                        $destiny_deleteTable = "DROP TABLE " . $newTableName;
                        $destiny_conn->query($destiny_deleteTable);
                        echo "Tabela anterior do banco de dados de destino excluída!\n";
                    }
                    
                    $destiny_sql = "CREATE TABLE finaltable.$newTableName AS SELECT * FROM $newTableName";
                    $destiny_createNewTable = $conn->query($destiny_sql);
                    
                    if ($conn->connect_error) {
                        die("Ocorreu um erro ao criar a nova tabela no banco de dados de destino: " . $conn->connect_error);
                    }
                    
                } catch (Exception $e) {
                    echo "Ocorreu um erro com a DB de destino: " . $e->getMessage();
                }
                
                echo "A tabela foi criada com sucesso a partir dos resultados da consulta.\n";
            } else {
                die("Erro ao criar a nova tabela: " . $conn->error) . "\n";
            }

    } else {
        die("Erro ao executar a consulta SQL: " . $conn->error) . "\n";
    }
    
    
    $file = fopen($fileName, 'w');

    if ($file === false) {
        die("Erro ao abrir o arquivo para gravação.");
    }
    
    $columnHeaders = array();
    
    // Certifique-se de que a codificação do arquivo seja UTF-8
    fwrite($file, "\xEF\xBB\xBF");
    
    fputcsv($file, $columnHeaders, ';');
    
    while ($row = $result->fetch_assoc()) {
        foreach ($row as $key => $value) {
            // Remova a conversão para entidades HTML, pois isso pode afetar caracteres especiais
            // $row[$key] = htmlentities($value);
    
            // Certifique-se de que os valores estejam na codificação correta (UTF-8)
            $row[$key] = iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $value);
        }
    
        fputcsv($file, $row, ';');
    }
    
    fclose($file);

    
    $conn->close();
    $destiny_conn->close();

    echo "Os dados foram gravados com sucesso no arquivo '$fileName'." . "\n";

} catch (Exception $e) {
    echo "Ocorreu um erro com a DB de origem: " . $e->getMessage();
}

?>