<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINKS CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/boxTop.css">
    <link rel="stylesheet" href="css/table.css">
    <!-- GOOGLE CSS -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <title>Tabelas</title>
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
                <a href="../manage/index.php">
                    Gerenciar logins
                </a>
            </div>
            <div class="table">
                <a href="index.php">
                    Tabelas
                </a>
            </div>
        </div>
        <div class="box-profile">
        </div>
    </div>
    <div class="table-box">
        <div class="title-box">
            <div class="title">Tabelas</div>
            <div class="buttons">
                <span class="material-symbols-outlined refresh-button">
                    refresh
                </span>
                <span class="material-symbols-outlined">
                    done
                </span>
            </div>
        </div>
        <div class="table-container">
            <div id="tabelas">
            <?php
                include "conn.php";
                // Consulta SQL para listar informações sobre as tabelas
                $sql = "SHOW TABLE STATUS";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $tableName = $row["Name"];
                        $tableRows = $row["Rows"];
            
                        // Verifique se a tabela possui algum dado
                        if ($tableRows > 0) {
                            echo '<a class="link" href="download.php?table=' . $tableName . ' " target="_blank">' . $tableName . '</a><br>';
                        }
                    }
                } else {
                    echo "<p style='height: 40px; width: 100%; color: white; background-color: var(--blue-bg-two);display: flex; justify-content: center; align-items: center;'>Nenhuma tabela encontrada no banco de dados.</p>";
                }
                // Fecha a conexão com o banco de dados
                $conn->close();
            ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>
