$(document).ready(function(){

    $('.add').click(function (event) {
        event.preventDefault();
        $('.box-login').addClass('show');
    });
    
    $('.close').click(function (event) {
        event.preventDefault();
        $('.box-login').removeClass('show');
    });
    
    $('.remove').click(function(event) {
        event.preventDefault();
        
        var userId = $(this).data('id');
        $("#id").text(userId);

        // Show the custom confirmation dialog
        $('.confirmation-dialog').addClass('show');

        // Handle the confirmation
        $('#confirm-delete').click(function() {
            $.ajax({
                type: "GET",
                url: "delete.php",
                data: { id: userId},
                success: function() {
                    location.reload();
                }
            });

            // Hide the dialog after confirmation
            $('.confirmation-dialog').removeClass('show');
        });
        // Handle cancel button
        $('#cancel-delete').click(function() {
            // Hide the dialog without taking any action
            $('.confirmation-dialog').removeClass('show');
        });
    });
    
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
                    setInterval(function() {
                        location.reload();
                    }, 2000);
                },
                error: function() {
                    errorText.text("Erro ao conectar-se ao servidor")
                    errorText.removeClass("success")
                }
            });
        }
    });
    
    $(document).click(function(event) {
        if (!$(event.target).closest('#form').length && !$(event.target).closest('.add').length) {
            $('.box-login').removeClass('show');
        }
        
        if (!$(event.target).closest('.confirmation-dialog').length && !$(event.target).closest('.remove').length) {
            $('.confirmation-dialog').removeClass('show');
        }
    });
});
