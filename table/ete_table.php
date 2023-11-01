<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            padding: 0;
            margin: 0;
        }
        
        body {
            position: relative;
            width: 100vw;
            height: 100vh;
            background-color: rgb(16, 83, 178);
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .index {
            position: absolute;
            background-color: #02ab14;
            color: white;
            padding: 10px;
            left: 2px;
            top: 2px;
            padding: 10px;
            color: white;
            width: fit-content;
            height: fit-content;
            border-radius: 10px;
            cursor: pointer;
            user-select: none;
        }
        
        form {
            background-color: rgb(26, 155, 195);
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding: 15px;
            border-radius: 10px;
        }

        .box {
            color: white;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }
        
        .box:hover {
            background-color: rgb(78, 144, 165);
        }
        
        .data {
            width: 98px;
            padding-left: 2px;
        }
        
        #hour {
            width: 100px;
            text-align: center;
        }        
        
        .button {
            display: flex;
            justify-content: center;
            gap: 5px;
        }
        
        .send, .clear {
            width: fit-content;
            padding: 10px;
            border: none;
            border-radius: 10px;
            color: white;
            cursor: pointer;
        }
        
        .send:hover, .clear:hover {
            filter: brightness(0.7);
        }
        
        .send {
            background-color: #4040ff;
        }
        
        .clear {
            background-color: gray;
        }
        
        .error {
            padding: 5px;
            background-color: #e24848c7;
            color: white;
            text-align: center;
            border-radius: 10px;
        }
        
        .success {
            padding: 5px;
            background-color: #5cc167c7;
            color: white;
            text-align: center;
            border-radius: 10px;
        }
        
    </style>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/ete_script.js"></script>
</body>
</html>