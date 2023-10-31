<?php
    // Conexão com o banco de dados (substitua com suas próprias credenciais)
    $servername = "localhost";
    $dbUsername = "pandin";
    $dbPassword = "P@nd1n@P";
    $dbName = "tabledb";

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
    
?>
