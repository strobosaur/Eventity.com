// WAIT FOR DOCUMENT TO LOAD
$(document).ready(function(){

    // VIEW THIS EVENT
    $('.view-event-btn').click(function(e) {
        e.preventDefault();
        var eventID = $(this).data("cid");
        stopUpdateEvents();
        getEventViewAjax(eventID);    
    });
})