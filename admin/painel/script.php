<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Dados de conexão com o banco de dados
    $servername = "";
    $dbUsername = "";
    $dbPassword = "";
    $dbName = "";

    try {
        $conn = new mysqli($servername, $dbUsername, $dbPassword, $dbName);
    } catch (mysqli_sql_exception $e) {
        echo "Erro ao conectar ao banco de dados. Por favor, tente novamente mais tarde.";
        exit;
    }

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Usar password_hash para criar um hash seguro da senha
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Preparar e executar a consulta para inserir o usuário no banco de dados
    $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "Erro ao criar o usuário: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    include "index.php";
}
?>