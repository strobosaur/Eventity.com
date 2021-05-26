// SEND POST TO DATABASE
$('#form-view-event-btn').submit(function(e) {
    e.preventDefault();
    var eventID = $("#eventID").val();

    $.ajax({
        url: 'event_view_ajax.php',
        type: 'POST',
        data: {
            'view_event': 1,
            'event_ID': eventID,
        },
        success: function(response){
            clearInterval(eventListUpdate);
            $('#event-list').empty();
            $('#event-list').append(response);
        }
    });
});