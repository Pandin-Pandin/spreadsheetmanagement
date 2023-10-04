<?php
// // Iniciar ou retomar a sessão
// session_start();

// // Verificar se o usuário está autenticado
// if (!isset($_SESSION["authenticated"]) || $_SESSION["authenticated"] !== true) {
//     header("Location: ../index.php"); // Redirecionar para a página de login
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MY STYLES -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/boxTop.css">
    <!-- GOOGLE CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Gerenciar Usuários</title>
</head>
<body>
    <div class="box-false"></div>
    <div class="box-top">
        <div class="box-links">
            <div class="home">
                <a href="index.php">
                    Home
                </a>
            </div>
            <div class="gerenciar">
                <a href="manage/index.php">
                    Gerenciar logins
                </a>
            </div>
            <div class="table">
                <a href="table/index.php">
                    Tabelas
                </a>
            </div>
        </div>
        <div class="box-profile">

        </div>
    </div>
    <div class="box-login" id="form">
        <div class="login-screen">
            <div class="title">Criar Login</div>
            <div class="profile-box">
                <span class="material-symbols-outlined">
                    person_add
                </span>
            </div>
            <div class="login-form">
                <div class="name">Nome</div>
                <input class="name-box" type="text" id="name" autocomplete="off" required />
            </div>
            <div class="passwd-form">
                <div class="passwd">Senha</div>
                <input class="passwd-box" type="password" id="passwd" autocomplete="off" required />
                <div class="error" id="error"></div>
            </div>
            <div class="box-submit">
                <input type="submit" value="Criar" class="submit-btn" id="submitBtn" />
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>