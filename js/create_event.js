// WAIT FOR DOCUMENT TO LOAD
$(document).ready(function(){

    // CREATE EVENT HANDLING
    $('#create-event-form').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("create", 1);

        $.ajax({
            url: 'event_create_process_ajax.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response){
                if (response == "true") {
                    getSideMenuAjax();
                    updateEventListAjax();
                    setTopBarMessage("Event created")
                    startUpdateEvents();
                } else {
                    setTopBarMessage("Event create failed")
                }
            }
        })
    })
})