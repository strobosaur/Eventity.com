// WAIT FOR DOCUMENT TO LOAD
$(document).ready(function(){

    // SIDE MENU BUTTON LISTENERS
    $("#create-event-btn").click(function(e){
        e.preventDefault;

        $.ajax({
            url: "event_create_ajax.php",
            type: "POST",
            data:{
                'create-event': 1,
            },
            success: function(response){
                stopUpdateEvents();
                $("#event-list").empty();
                $("#event-list").append(response);
                $.getScript("./js/create_event.js");
            }
        })
    })
})