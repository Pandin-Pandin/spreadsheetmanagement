<?php
    // Conexão com o banco de dados (substitua com suas próprias credenciais)
    $servername = "localhost";
    $dbUsername = "pandin";
    $dbPassword = "P@nd1n@P";
    $dbName = "etedb";
    $dbTable = "etetable";

    // Tentar criar a conexão com o banco de dados
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

    // Verificar erros na conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Configurar o conjunto de caracteres
    $conn->set_charset("utf8");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $ete = $_POST['ete'];
        $hour = $_POST['hour'];
        $phAfluente = $_POST['phAfluente'];
        $phTanque = $_POST['phTanque'];
        $od = $_POST['od'];
        $sedimentabilidade = $_POST['sedimentabilidade'];
        $phEfluente = $_POST['phEfluente'];
        $vazao = $_POST['vazao'];
        
        $dataName = [
            "ete",
            "hour",
            "phAfluente",
            "phTanque",
            "od",
            "sedimentabilidade",
            "phEfluente",
            "vazao"
        ];
        
        $dataNameConcatenada = implode(",", $dataName);
        
        // Validar e limpar os dados (exemplo: mysqli_real_escape_string ou outras funções de validação)
        // Certifique-se de que os dados sejam seguros antes de inseri-los no banco de dados.

        $sql = "INSERT INTO $dbTable ($dataNameConcatenada) VALUES (" . implode(", ", array_fill(0, 8, "?")) . ")";

        $stmt = $conn->prepare($sql);

        // Verificar erros na preparação da consulta
        if ($stmt === false) {
            echo "Erro na preparação da consulta: " . $conn->error;
        } else {
        
            $stmt->bind_param("ssssssss", $ete, $hour, $phAfluente, $phTanque, $od, $sedimentabilidade, $phEfluente, $vazao);
            
            // Bind and execute the prepared statement
            $stmt->execute();
            
            // Verificar erros na execução da consulta
            if ($stmt->error) {
                echo $stmt->error;
            } else {
                echo "Dados inseridos com sucesso!";
            }           
            
            // Fechar a declaração preparada
            $stmt->close();
        }
        // Fechar a conexão com o banco de dados
        $conn->close();
    }
?>
