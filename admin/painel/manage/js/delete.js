$(document).ready(function(){
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
                success: function(response) {
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
});
