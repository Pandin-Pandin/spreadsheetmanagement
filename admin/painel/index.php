<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MY STYLES -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/boxTop.css">
    <link rel="stylesheet" href="css/tableUsers.css">
    <!-- GOOGLE CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Gerenciar logins</title>
</head>
<body>
    <div class="box-false"></div>
    <div class="box-top">
        <div class="box-links">
            <div class="gerenciar">
                <a href="index.php">
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
    <div class="table-box">
        <div class="title">
            Logins
            <span class="material-symbols-outlined add">
                    person_add
            </span>
        </div>
        <div class="user-container">
            <div class="user-table">
            <?php
                include "conn.php";
                // Consulta para obter a lista de usuários
                $query = "SELECT id, username FROM users";
                $result = $conn->query($query);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='user'>";
                        echo "<div class='name'>" . $row["username"] . "</div>";
                        echo "<div class='box-btn'>
                                <a class='btn remove' href='#' data-id='" . $row["id"]  .  "'>
                                    <span class='material-symbols-outlined delete'>
                                        person_remove
                                    </span>
                                </a>
                            </div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p style='height: 40px; width: 100%; color: white; background-color: var(--blue-bg-two);display: flex; justify-content: center; align-items: center;'>Nenhum usuário encontrado.</p>";
                }
                $conn->close();
                ?>
            </div>
        </div>
    </div>
    <div class="box-login" id="form">
        <div class="login-screen">
            <span class="material-symbols-outlined close">
                close
            </span>
            <div class="title">Criar Login</div>
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
    <div class="confirmation-dialog">
        <p>Tem certeza que deseja excluir o usuário <span id="username"></span>?</p>
        <button id="confirm-delete">Confirmar</button>
        <button id="cancel-delete">Cancelar</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>