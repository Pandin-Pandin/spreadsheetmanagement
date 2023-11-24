<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ete_style.css">
    <title>Tabela ETE</title>
</head>
<body>
    <div class="index">Planilha</div>
    <form id="eteTable">
        <div class="box">
            <div class="title">ETE:</div>
            <input class="data" type="text" name="" id="ete">
        </div>
        <div class="box">
            <div class="title">Horário da análise:</div>
            <div id="hour"></div>
        </div>
        <div class="box">
            <div class="title">pH afluente:</div>
            <input class="data" type="text" name="" id="phAfluente">
        </div>
        <div class="box">
            <div class="title">pH tanque de aeração:</div>
            <input class="data" type="text" name="" id="phTanque">
        </div>
        <div class="box">
            <div class="title">OD:</div>
            <input class="data" type="text" name="" id="od">
        </div>
        <div class="box">
            <div class="title">Sedimentabilidade lodo tanque de aeração:</div>
            <input class="data" type="text" name="" id="sedimentabilidade">
        </div>
        <div class="box">
            <div class="title">PH efluente:</div>
            <input class="data" type="text" name="" id="phEfluente">
        </div>
        <div class="box">
            <div class="title">Vazão calha Parshall:</div>
            <input class="data" type="text" name="" id="vazao">
        </div>
        <div class="button">
            <input class="send" type="submit" value="Enviar Dados">
            <input class="clear" type="button" id="clearData" value="Limpar Campos">
        </div>
        <div class="warning"></div>
        </form>
        <div class="confirmation-dialog">
            <p>Existe um formulário criado na hora atual. Você deseja substituí-lo?</p>
            <button id="confirm-delete">Confirmar</button>
            <button id="cancel-delete">Cancelar</button>
        </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/ete_script.js"></script>
</body>
</html>