// FUNCTION ATTEND EVENT
$("#form-event-attend-btn").submit(function(e) {
    e.preventDefault();

    var eventID = $("#eventID").val();
    var userID = $("#attendingID").val();

    $.ajax({
        url: 'event_attend_ajax.php',
        type: 'POST',
        data: {
            'attend-event': 1,
            'eventID': eventID,
            'userID': userID,
        },
        success: function(response){
            setTopBarMessage("You are attending this event")
        }
    })
})