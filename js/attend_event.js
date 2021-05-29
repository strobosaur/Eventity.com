// ATTEND EVENT
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
            getEventViewAjax(eventID);
            setTopBarMessage("You are attending this event")
            get
        }
    })
})

// DON'T ATTEND EVENT
$("#form-remove-attend-btn").submit(function(e) {
    e.preventDefault();

    var eventID = $("#eventID").val();
    var userID = $("#attendingID").val();

    $.ajax({
        url: 'event_attend_remove_ajax.php',
        type: 'POST',
        data: {
            'remove-attend': 1,
            'eventID': eventID,
            'userID': userID,
        },
        success: function(response){
            getEventViewAjax(eventID);
            setTopBarMessage("You will not attend this event")
        }
    })
})