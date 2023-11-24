$(document).ready(function() {

    var $formBtn = $(".form");
    var $formBox = $('.form-box');
    var $tableBtn = $(".table");
    var $tableBox = $('.table-box');
    var $firstSpanTable = $(".refresh-button-table");
    var $secondSpanTable = $(".done-table");
    var $refreshButtonTable = $(".refresh-button-table");
    var $firstSpanForm = $(".refresh-button-form");
    var $secondSpanForm = $(".done-form");
    var $refreshButtonForm = $(".refresh-button-form");
    
    function getButtonState() {
        return localStorage.getItem('buttonState');
    }
    
    function setButtonState(state) {
        localStorage.setItem('buttonState', state);
    }
    
    $formBtn.click(function() {
        $tableBox.addClass("disable");
        $formBox.removeClass("disable");
        $formBox.addClass("enable");
        
        setButtonState('form');
    });
    
    $tableBtn.click(function() {
        $formBox.addClass("disable");
        $tableBox.removeClass("disable");
        $tableBox.addClass("enable");
        
        setButtonState('table');
    });
        
    var savedButtonState = getButtonState();

    // Se houver um estado salvo, aplica-o
    if (savedButtonState === 'form') {
        $formBtn.click();
    } else if (savedButtonState === 'table') {
        $tableBtn.click();
    }    
    
    function rotateAndToggleTable() {
        // Rotate the first span
        $firstSpanTable.addClass("rotate");
        $firstSpanTable.addClass("rotate");

        // After a delay, show the second span
        setTimeout(function() {
            $firstSpanTable.addClass("disable");
            $secondSpanTable.addClass("show");
            $firstSpanTable.addClass("disable");
            $secondSpanTable.addClass("show");

            // After 2 seconds, hide the second span and re-enable the first span
            setTimeout(function() {
                $secondSpanTable.removeClass("show");
                $firstSpanTable.removeClass("rotate");
                $firstSpanTable.removeClass("disable");
                $secondSpanTable.removeClass("show");
                $firstSpanTable.removeClass("rotate");
                $firstSpanTable.removeClass("disable");

                // Re-enable the first span with a click event
                $firstSpanTable.click(rotateAndToggleTable);
                $firstSpanTable.click(rotateAndToggleTable);
            }, 2000); // 2 seconds
        }, 700); // 0.7 seconds
    }

    // Initially, attach the click event to the first span
    $firstSpanTable.click(rotateAndToggleTable);
    $firstSpanTable.click(rotateAndToggleTable);

    // Função para atualizar a lista de tabelas
    function atualizarTabelas() {
        $.ajax({
            url: 'merge.php',
            method: 'GET',
            success: function() {
                $.ajax({
                    url: 'tables.php',
                    url: 'tables.php',
                    method: 'GET',
                    success: function(data) {
                        // Atualize o conteúdo da div .table-box com os dados atualizados
                        $('box-data').html(data);
                        $('box-data').html(data);
                        // Desvincule o evento de clique antes de adicioná-lo novamente
                        $refreshButtonTable.off('click');
                        $refreshButtonTable.click(function() {
                        $refreshButtonTable.off('click');
                        $refreshButtonTable.click(function() {
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
            }
        });
    }

    // Adicione um manipulador de eventos de clique para o botão de atualização
    $refreshButtonTable.click(function() {
    $refreshButtonTable.click(function() {
        // Chame a função para atualizar as tabelas
        atualizarTabelas();
    });

    $('.table-container').on('click', '.view-table', function() {
        var tableName = $(this).data('table');
        var url = 'view_table.php?table=' + tableName;
        window.open(url, '_blank');
    });
    
    function rotateAndToggleForm() {
        // Rotate the first span
        $firstSpanForm.addClass("rotate");

        // After a delay, show the second span
        setTimeout(function() {
            $firstSpanForm.addClass("disable");
            $secondSpanForm.addClass("show");

            // After 2 seconds, hide the second span and re-enable the first span
            setTimeout(function() {
                $secondSpanForm.removeClass("show");
                $firstSpanForm.removeClass("rotate");
                $firstSpanForm.removeClass("disable");

                // Re-enable the first span with a click event
                $firstSpanForm.click(rotateAndToggleForm);
            }, 2000); // 2 seconds
        }, 700); // 0.7 seconds
    }

    // Initially, attach the click event to the first span
    $firstSpanForm.click(rotateAndToggleForm);
    
    function atualizarFormularios() {
        $.ajax({
            url: 'form.php',
            method: 'GET',
            success: function(data) {
                // Atualize o conteúdo da div .table-box com os dados atualizados
                $('box-data').html(data);
                // Desvincule o evento de clique antes de adicioná-lo novamente
                $refreshButtonForm.off('click');
                $refreshButtonForm.click(function() {
                    // Chame a função para atualizar as tabelas
                    atualizarFormularios();
                });
            }
        });
    }
    
    $refreshButtonTable.click(function() {
        // Chame a função para atualizar as tabelas
        atualizarFormularios();
    });
    
    $(".table-name").each(function(index) {
        var $titleBtn = $(this);
        var $elementosOcultos = $(".data-form");
        var $spanArrow = $titleBtn.find("span");

        $titleBtn.click(function() {
            $elementosOcultos.each(function(elementoIndex) {
                if (elementoIndex === index) {
                    if ($spanArrow.hasClass("bottom")) {
                        $(this).removeClass("disable");
                        $spanArrow.removeClass("bottom").addClass("top");
                    } else {
                        $(this).removeClass("grid").addClass("disable");
                        $spanArrow.removeClass("top").addClass("bottom");
                    }
                } else {
                    $(this).addClass("disable");
                    var $otherButton = $(".table-name:eq(" + elementoIndex + ")");
                    var $otherSpanArrow = $otherButton.find("span");
                    $otherSpanArrow.removeClass("top").addClass("bottom");
                }
            });
        });
    });
    
    function rearrangeElements() {
        if (window.innerWidth <= 1155) {
            $(".data-form").each(function() {
                // Para cada tabela, encontrar os grids correspondentes
                var $gridThree = $(this).find(".grid-three");
                var $gridFour = $(this).find(".grid-four");
    
                // Mover os grids correspondentes
                $gridThree.insertAfter($(this).find(".grid-one"));
                $gridFour.insertAfter($(this).find(".grid-two"));
            });
        }
    }
    
    // Chama a função ao carregar a página
    rearrangeElements();
    
    // Adiciona um ouvinte de redimensionamento para reorganizar os elementos quando a tela for redimensionada
    $(window).resize(function() {
        rearrangeElements();
    });
    
});