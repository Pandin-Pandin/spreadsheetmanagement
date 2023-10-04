<?php

include "conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $query = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashedPasswordFromDatabase);

    if ($stmt->fetch() && password_verify($password, $hashedPasswordFromDatabase)) {
        echo "success";
    } else {
        echo "Credenciais inválidas. Verifique seu nome de usuário e senha.";
    }

    $stmt->close();
    $conn->close();
} else {
    include "index.php";
}
?>