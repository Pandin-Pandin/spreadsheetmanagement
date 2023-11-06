<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- LINKS CSS -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../css/boxTop.css">
    <link rel="stylesheet" href="css/table.css">
    <link rel="stylesheet" href="css/form.css">
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
    <div class="container table-box">
        <div class="title-box">
            <div class="form"></div>
            <div class="title">Planilhas</div>
            <div class="buttons">
                <span class="material-symbols-outlined refresh-button-table">
                    refresh
                </span>
                <span class="material-symbols-outlined done-table">
                    done
                </span>
            </div>
        </div>
        <div class="table-container">
            <?php
                include "tables.php";
            ?>
        </div>
    </div>
    <div class="container form-box disable">
        <div class="title-box">
            <div class="table"></div>
            <div class="title">Formulários</div>
            <div class="buttons">
                <span class="material-symbols-outlined refresh-button-form">
                    refresh
                </span>
                <span class="material-symbols-outlined done-form">
                    done
                </span>
            </div>
        </div>
        <div class="form-container">
            <?php
                include "form.php";
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="js/script.js"></script>
</body>
</html>