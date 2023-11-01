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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <title>Tabelas</title>
</head>
<body>
    <div class="box-false"></div>
    <div class="box-top">
        <div class="box-links">
            <div class="gerenciar">
                <a href="../index.php">
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
                include "update.php";
            ?>
            </div>
        </div>
    </div>
</body>
</html>
