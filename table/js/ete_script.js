$(document).ready(function () {
    
    $('.index').click(function() {
        var url = 'index.php';
        window.open(url, '_blank');
    });
    
    $(".data").on("input", function() {
        // Esta função é chamada quando o usuário começa a digitar nos campos de nome de usuário ou senha.
        // Vamos esconder o alerta de erro.
        $(".warning").html(""); // Limpar o texto do alerta de erro
    });
    
    $(document).click(function(event) {
        if (!$(event.target).closest('.send').length) {
            $(".warning").html(""); // Clear the error message
        }
    });

    function currentHour() {
        var hour = new Date().getHours() + ":00";
        var hourText = $("#hour");
        hourText.text(hour);
    };
    
    currentHour();
    
    setInterval(function() {
        currentHour();
    }, 100);
    
    
    $('.send').click(function(event) {
        event.preventDefault();
        
        var allValuesFilled = true;
        
        $("input.data").each(function() {
            if ($(this).val().trim() === "") {
                allValuesFilled = false;
                return false;
            }
            console.log($(this).val().trim());
            console.log(allValuesFilled);
        });
        
        var ete = $("#ete").val().trim();
        var hour = new Date().getHours() + ":00";
        var phAfluente = $("#phAfluente").val().trim();
        var phTanque = $("#phTanque").val().trim();
        var od = $("#od").val().trim();
        var sedimentabilidade = $("#sedimentabilidade").val().trim();
        var phEfluente = $("#phEfluente").val().trim();
        var vazao = $("#vazao").val().trim();

        if (allValuesFilled) {
            console.log("Está tudo preenchido");
            $.ajax({
                type: "POST",
                url: "ete_script.php",
                data: {
                    ete: ete,
                    hour: hour,
                    phAfluente: phAfluente,
                    phTanque: phTanque,
                    od: od,
                    sedimentabilidade: sedimentabilidade,
                    phEfluente: phEfluente,
                    vazao: vazao
                },
                success: function(response) {
                    if (response.includes("erro")) {
                        $(".warning").html("<p class='error'>" + response + "</p>");
                    } else {
                        // Dados inseridos com sucesso
                        $(".warning").html("<p class='success'>" + response + "</p>");
                    }
                    
                    setTimeout(function() {
                        $(".warning").html("");
                    }, 4000);
                },
                error: function() {
                    $(".warning").html("<p class='error'>Erro ao se conectar ao servidor</p>");

                    setTimeout(function() {
                        $(".warning").html("");
                    }, 4000);
                }
            });
            
        } else {
            console.log("Não está tudo preenchido");
            $(".warning").html("<p class='error'>Preencha todas as informações</p>");

            setTimeout(function() {
                $(".warning").html("");
            }, 5000);
        }
    });
    
    // Verifique se o navegador oferece suporte ao localStorage
if (typeof(Storage) !== "undefined") {
    // Recuperar dados salvos no localStorage e preencher os campos do formulário
    $("input.data").each(function() {
        var fieldName = $(this).attr("id");
        var savedValue = localStorage.getItem(fieldName);

        if (savedValue) {
            $(this).val(savedValue);
        }
    });

    // Evento para salvar os dados do input no localStorage quando o valor é alterado
    $("input.data").on("input", function() {
        var fieldName = $(this).attr("id");
        var fieldValue = $(this).val();
        localStorage.setItem(fieldName, fieldValue);
    });

    // Limpar os dados do localStorage quando o botão "Limpar" é clicado
    $("#clearData").click(function() {
        $("input.data").each(function() {
            var fieldName = $(this).attr("id");
            localStorage.removeItem(fieldName);
        });
    });
    } else {
        // O navegador não suporta localStorage, lide com isso de forma adequada
        console.log("Desculpe, o seu navegador não suporta localStorage.");
    }
    
    $("#clearData").click(function() {
        // Reset the form to clear all input fields
        $("#eteTable")[0].reset();
    });
    
    $(window).on("beforeunload", function () {
        return "Tem certeza que deseja sair? Todas as alterações não salvas serão perdidas.";
    });
    
});