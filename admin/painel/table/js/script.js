$(document).ready(function() {

    var $firstSpan = $(".buttons span:first");
    var $secondSpan = $(".buttons span:nth-child(2)");
    var $refreshButton = $(".refresh-button");

    function rotateAndToggle() {
        // Rotate the first span
        $firstSpan.addClass("rotate");

        // After a delay, show the second span
        setTimeout(function() {
            $firstSpan.addClass("disable");
            $secondSpan.addClass("show");

            // After 2 seconds, hide the second span and re-enable the first span
            setTimeout(function() {
                $secondSpan.removeClass("show");
                $firstSpan.removeClass("rotate");
                $firstSpan.removeClass("disable");

                // Re-enable the first span with a click event
                $firstSpan.click(rotateAndToggle);
            }, 2000); // 2 seconds
        }, 700); // 0.7 seconds
    }

    // Initially, attach the click event to the first span
    $firstSpan.click(rotateAndToggle);

    // Função para atualizar a lista de tabelas
    function atualizarTabelas() {
        $.ajax({
            url: 'merge.php',
            method: 'GET',
            success: function() {
                $.ajax({
                    url: 'update.php',
                    method: 'GET',
                    success: function(data) {
                        console.log("Funcionou o update");
                        // Atualize o conteúdo da div .table-box com os dados atualizados
                        $('#tabelas').html(data);
                        // Desvincule o evento de clique antes de adicioná-lo novamente
                        $refreshButton.off('click');
                        $refreshButton.click(function() {
                            console.log("Botão clicado");
                            // Chame a função para atualizar as tabelas
                            atualizarTabelas();
                        });
                    },
                    error: function() {
                        console.log("Erro ao unir tabelas");
                        alert('Erro ao atualizar as tabelas.');
                    }
                });
            },
            error: function() {
                console.log("Erro ao unir tabelas");
                alert('Erro ao unir tabelas.');
            }
        });
    }

    // Adicione um manipulador de eventos de clique para o botão de atualização
    $refreshButton.click(function() {
        console.log("Botão clicado");
        // Chame a função para atualizar as tabelas
        atualizarTabelas();
    });

    $('.table-container').on('click', '.view-table', function() {
        var tableName = $(this).data('table');
        var url = 'view_table.php?table=' + tableName;
        window.open(url, '_blank');
    });
});