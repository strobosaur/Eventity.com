// WAIT FOR DOCUMENT TO LOAD
$(document).ready(function(){

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

    // UPDATE EVENT INFO BUTTON
    $("#update-event-btn").click(function(e) {
        e.preventDefault();

        var eventID = $(this).data("cid");

        $.ajax({
            url: 'event_update_ajax.php',
            type: 'POST',
            data: {
                'update-event': 1,
                'eventID': eventID,
            },
            success: function(response){
                $("#event-list").empty();
                $("#event-list").append(response);
                $.getScript("./js/update_event.js");
                /*getEventViewAjax(eventID);
                setTopBarMessage("Event info updated")*/
            }
        })
    })

    // DELETE EVENT BUTTON
    $("#delete-event-btn").click(function(e) {
        e.preventDefault();

        var eventID = $(this).data("cid");
        console.log(eventID);

        $.ajax({
            url: 'event_delete_process_ajax.php',
            type: 'POST',
            data: {
                'delete-event': 1,
                'eventID': eventID,
            },
            success: function(response){
                console.log(response);
                updateEventListAjax();
                setTopBarMessage("Your event has been deleted")
            }
        })
    })
})
