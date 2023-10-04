<?php

    include "conn.php";

    if ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["id"])) {
        $userId = $_GET["id"];
    
        // Consulta para excluir o usuário
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $userId);
    
        if ($stmt->execute()) {
            echo "Usuário excluído com sucesso.";
        } else {
            echo "Erro ao excluir o usuário: " . $stmt->error;
        }
    
        $stmt->close();
        $conn->close();
    } else {
        echo "Requisição inválida.";
    }
?>