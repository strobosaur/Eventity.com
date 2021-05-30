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
            if (response !== false) {
                getSideMenuAjax();
                updateEventListAjax();
                setTopBarMessage("Event created")
            } else {
                setTopBarMessage("Event create failed")
            }
        }
    })
})