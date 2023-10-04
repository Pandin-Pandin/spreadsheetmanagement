$(document).ready(function() {

    $("#name, #passwd").on("input", function() {
        // Esta função é chamada quando o usuário começa a digitar nos campos de nome de usuário ou senha.
        // Vamos esconder o alerta de erro.

        $("#error").text(""); // Limpar o texto do alerta de erro
    });

    $("#name, #passwd").on("keyup", function(event) {
        if (event.key === "Enter") {
            $("#submitBtn").click();
        }
    });

    $("#submitBtn").click(function(event) {
        event.preventDefault();

        var usernameValue = $("#name").val().trim();
        var passwordValue = $("#passwd").val().trim();

        var errorText = $("#error");

        if (usernameValue === "" || passwordValue === "") {
            errorText.text("Usuário e/ou senha vazio(s)");
            errorText.removeClass("success")
        } else {
            $.ajax({
                type: "POST",
                url: "script.php",
                data: {
                    username: usernameValue,
                    password:  passwordValue
                },

                success: function(response) {
                    if (response === "success") {
                        errorText.text("Usuário criado com sucesso!");
                        errorText.addClass("success")
                    } else {
                        errorText.text(response);
                        errorText.removeClass("success")
                    }
                },
                error: function() {
                    errorText.text("Erro ao conectar-se ao servidor")
                    errorText.removeClass("success")
                }
            });
        }
    });
});