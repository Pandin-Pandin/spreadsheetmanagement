<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- MY STYLES -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/boxTop.css">
    <link rel="stylesheet" href="css/tableUsers.css">
    <!-- GOOGLE CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Gerenciar logins</title>
</head>
<body>
    <div class="box-false"></div>
    <div class="box-top">
        <div class="box-links">
            <div class="home">
                <a href="../index.php">
                    Home
                </a>
            </div>

            <div class="gerenciar">
                <a href="index.php">
                    Gerenciar logins
                </a>
            </div>
            <div class="table">
                <a href="../table/index.php">
                    Tabelas
                </a>
            </div>
        </div>
        <div class="box-profile">
        </div>
    </div>
    
    <div class="table-box">
        <div class="title">Painel</div>
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
                                    <span class='material-symbols-outlined'>
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
    <div class="confirmation-dialog">
        <p>Tem certeza que deseja excluir o usuário <span id="username"></span>?</p>
        <button id="confirm-delete">Confirmar</button>
        <button id="cancel-delete">Cancelar</button>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/delete.js"></script>
</body>
</html>