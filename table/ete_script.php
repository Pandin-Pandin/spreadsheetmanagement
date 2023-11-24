<?php
    // Conexão com o banco de dados (substitua com suas próprias credenciais)
    $servername = "localhost";
    $dbUsername = "pandin";
    $dbPassword = "P@nd1n@P";
    $dbName = "etedb";
    
    // Tentar criar a conexão com o banco de dados
    $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);

    // Verificar erros na conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Configurar o conjunto de caracteres
    $conn->set_charset("utf8");
    
    date_default_timezone_set('America/Sao_Paulo');
    $date = date("d_m_y");
    
    $sqlComplement = "SHOW TABLES LIKE '$date'";
    
    if ($conn->query($sqlComplement)->num_rows === 0) {
        $createNewTable = "CREATE TABLE $date (
            ete VARCHAR(255),
            hour TIME,
            phAfluente DECIMAL(5,2),
            phTanque DECIMAL(5,2),
            od DECIMAL(5,2),
            sedimentabilidade VARCHAR(5),
            phEfluente DECIMAL(5,2),
            vazao DECIMAL(5,2)
        )";
        
        if ($conn->query($createNewTable) === TRUE) {
            echo "Tabela $date criada com sucesso.<br>";
        } else {
            echo "Erro ao criar a tabela: " . $conn->error;
        }
    }
    
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

        $insertData = "INSERT INTO $date ($dataNameConcatenada) VALUES (" . implode(", ", array_fill(0, 8, "?")) . ")";

        $stmt = $conn->prepare($insertData);

        // Verificar erros na preparação da consulta
        if ($stmt === false) {
            echo "Erro na preparação da consulta: " . $conn->error;
        } else {
        
            $stmt->bind_param("ssssssss", $ete, $hour, $phAfluente, $phTanque, $od, $sedimentabilidade, $phEfluente, $vazao);
            
            // Verificar erros na execução da consulta
            if ($stmt->error) {
                echo "Erro na declaração preparada: " . $stmt->error;
            } else {
                if ($stmt->execute()) {
                    echo "Dados inseridos com sucesso!";
                } else {
                    echo "Erro na execução da consulta: " . $stmt->error;
                }
            }           
            
            // Fechar a declaração preparada
            $stmt->close();
        }
    }
    // Fechar a conexão com o banco de dados
    $conn->close();
?>
