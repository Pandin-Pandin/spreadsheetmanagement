$(document).ready(function () {

    $('.ete').click(function() {
        var url = 'ete_table.php';
        window.open(url, '_blank');
    });
    
    var previousTime = null;
    
    $('.ete').click(function() {
        var url = 'ete_table.php';
        window.open(url, '_blank');
    });
    
    var previousTime = null;
    
    function serverTime() {
        currentTime = new Date();
        year = currentTime.getFullYear();
        month = currentTime.getMonth() + 1;
        day = currentTime.getDate();
        hour = currentTime.getHours();
        minute = currentTime.getMinutes();
        second = currentTime.getSeconds();
        time = year + "" + (month < 10 ? "0" : "") + month + "" + (day < 10 ? "0" : "") + day + "" + (hour < 10 ? "0" : "") + hour + "" + (minute < 10 ? "0" : "") + minute;
        
        if (previousTime === null) {
            previousTime = hour;
        } else if (hour !== previousTime) {
            // A mudança de hora ocorreu
            location.reload();
            previousTime = hour;
        }
    };
        
        if (previousTime === null) {
            previousTime = hour;
        } else if (hour !== previousTime) {
            // A mudança de hora ocorreu
            location.reload();
            previousTime = hour;
        }
    };
    
    serverTime();
    
    function hourVerify(time, buttonClicked) {
        
        var strTime = time.toString();
        var strButtonClicked = buttonClicked.toString();
        
        if (strTime === strButtonClicked) {
            $("#submitData").removeClass("no-editable").addClass("no-editable");
        } else {
            $("#submitData").removeClass("no-editable");
        };
    };
    
    setInterval(function() {
        hourVerify(time, buttonClicked);
        
        
        serverTime();

        var elements = $("td input");
        var currentClass = "column-[" + hour + "]";
        
        elements.each(function() {
           var element = $(this);
           if (element.hasClass(currentClass)) {
                element.removeClass("no-editable").addClass("editable");
            } else {
                element.addClass("no-editable");
            }
        });
    }, 100);
    

        var elements = $("td input");
        var currentClass = "column-[" + hour + "]";
        
        elements.each(function() {
           var element = $(this);
           if (element.hasClass(currentClass)) {
                element.removeClass("no-editable").addClass("editable");
            } else {
                element.addClass("no-editable");
            }
        });
    }, 100);
    
    function showError(message) {
        $("#error").html("<p class='error'>" + message + "</p>");
        
        
        setTimeout(function() {
            $("#error").html("");
        }, 4000);
    }
    
    
    var buttonClicked = localStorage.getItem("time");
    
    
    $("#submitData").click(function (event) {
    
        var allValuesFilled = true;
        
        $(".editable").each(function() {
            if ($(this).val().trim() === "") {
                allValuesFilled = false;
                return false;
            }
        });
        
    
        var allValuesFilled = true;
        
        $(".editable").each(function() {
            if ($(this).val().trim() === "") {
                allValuesFilled = false;
                return false;
            }
        });
        
        event.preventDefault(); // Prevent form submission

        if (allValuesFilled) {

            $.ajax({
                type: "POST",
                url: "script.php", // Update the URL to point to your PHP file
                data: $("#dataForm").serialize(),
                success: function (response) {
                    buttonClicked = time;
                    localStorage.setItem("time", buttonClicked);
                    // Handle success, show a success message in green
                    $("#error").html(response);
                    setTimeout(function() {
                        $("#error").html("");
                    }, 4000);
                },
                error: function (xhr, status, error) {
                    // Handle errors, show an error message in red
                    if (xhr.status === 0) {
                        showError("Verifique a sua conexão com a internet.");
                    } else if (xhr.status === 404) {
                        showError("Servidor não encontrado.");
                    } else {
                        showError("Ocorreu um erro: " + error);
                    }
                }
            });

            $("#submitData").addClass("no-editable");

            console.log("Todos os input's da coluna estão preenchidos!");

        } else {

            $("#error").html("<p class='error'>Algum input da coluna " + 
            hour
                + " atual está vazio</p>");

            setTimeout(function() {
                $("#error").html("");
            }, 4000);
        }
        console.log("Momento em que o botão foi clicado: ", buttonClicked); 
    });

    // Hide error message when clicking anywhere on the screen except the button
    $(document).click(function(event) {
        if (!$(event.target).closest('#submitData').length && !$(event.target).closest('#clearData').length) {
            $("#error").html(""); // Clear the error message
        }
    });    

    // Clear button click event handler
    $("#clearData").click(function() {
        $("#error").html("<p class='success'>Todos os input's foram limpos.</p>");
        setTimeout(function() {
            $("#error").html("");
        }, 4000);
        // Reset the form to clear all input fields
        $("#dataForm")[0].reset();
    });

    $(window).on("beforeunload", function () {
        return "Tem certeza que deseja sair? Todas as alterações não salvas serão perdidas.";
    });
});