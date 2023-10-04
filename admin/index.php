<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- LINKS CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- GOOGLE CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
</head>
<body>
    <div class="box-login" id="form">
        <div class="login-screen">
            <div class="title">Login</div>
            <div class="profile-box">
                <span class="material-symbols-outlined">
                    shield_person
                </span>
            </div>
            <div class="login-form">
                <div class="name">Nome</div>
                <input class="name-box" type="text" id="name" required />
            </div>
            <div class="passwd-form">
                <div class="passwd">Senha</div>
                <input class="passwd-box" type="password" id="passwd" required />
                <div id="error" style="color: red;"></div>
            </div>
            <div class="box-submit">
                <input type="submit" value="Entrar" class="submit-btn" id="submitBtn" />
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
