// UPDATE EVENT INFO HANDLING
$('#update-event-form').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    formData.append("update-event", 1);

    $.ajax({
        url: 'event_update_process_ajax.php',
        type: 'POST',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response){
            console.log(response);
            if (response !== "false") {
                getSideMenuAjax();
                getEventViewAjax(response);
                setTopBarMessage("Event info updated")
                startUpdateEvents();
            } else {
                setTopBarMessage("Event update failed")
            }
        }
    })
})