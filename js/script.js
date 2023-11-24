$(document).ready(function() {
    // Esta função é executada quando o documento HTML está totalmente carregado e pronto para ser manipulado.
    
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
        // Aqui estamos adicionando um ouvinte de evento de clique no elemento com o id "submitBtn", que é o botão de login.

        event.preventDefault();
        // Essa linha impede o comportamento padrão do botão de enviar, que seria recarregar a página.

        var usernameValue = $("#name").val().trim();
        var passwordValue = $("#passwd").val().trim();
        // Estamos pegando os valores dos campos de nome de usuário e senha e removendo os espaços em branco iniciais e finais.

        var errorText = $("#error");
        // Pegamos o elemento com o id "error" que será usado para exibir mensagens de erro.

        if (usernameValue === "" || passwordValue === "") {
            // Verifica se os campos de nome de usuário e senha estão vazios.
            errorText.text("Usuário e/ou senha vazios");
            // Se um dos campos estiver vazio, exibimos uma mensagem de erro no elemento de erro.

        } else {
            // Se ambos os campos tiverem sido preenchidos, continuamos com a requisição AJAX.

            $.ajax({
                type: "POST",
                url: "script.php",
                // Definimos o método de requisição (POST) e a URL para onde iremos enviar os dados.

                data: {
                    username: usernameValue,
                    password: passwordValue
                },
                // Aqui estamos definindo os dados que serão enviados para o servidor, ou seja, o nome de usuário e a senha.

                success: function(response) {
                    // A função de sucesso é chamada quando a requisição é bem-sucedida e o servidor retorna uma resposta.

                    if (response === "success") {
                        // Se a resposta for "success", significa que as credenciais foram válidas.
                        window.location.href = "table/index.php";
                        // Redirecionamos o usuário para a página de dashboard.
                    } else {
                        // Se a resposta não for "success", então houve um erro de autenticação.
                        errorText.text(response);
                        // Exibimos a mensagem de erro retornada pelo servidor no elemento de erro.
                    }
                },
                error: function() {
                    // A função de erro é chamada quando há um erro na requisição AJAX.
                    errorText.text("Erro ao conectar-se ao servidor.");
                    // Exibimos uma mensagem de erro genérica no elemento de erro.
                }
            });
        }
    });
});
