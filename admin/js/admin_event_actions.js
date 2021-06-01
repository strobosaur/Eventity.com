// ADMIN APPROVE EVENT BUTTON
$(".event-admin-deny-btn").click(function(e){
    e.preventDefault;
    var cid = $(this).data('cid');

    $.ajax({
        url: "event_delete_process_ajax.php",
        type: "POST",
        data: {
            "delete-event": 1,
            "eventID": cid,
        },
        success: function(response){
            if(response != "false"){
                updateEventListAdmin();
                setTopBarMessage("Event removed");
            } else {
                setTopBarMessage("Event couldn't be removed");
            }
        }
    })
})

// ADMIN APPROVE EVENT BUTTON
$(".event-admin-ok-btn").click(function(e){
    e.preventDefault;
    var cid = $(this).data('cid');

    $.ajax({
        url: "admin_event_approve_ajax.php",
        type: "POST",
        data: {
            "approve-event": 1,
            "eventID": cid,
        },
        success: function(response){
            if(response != "false"){
                updateEventListAdmin();
                setTopBarMessage("Event approved");
            } else {
                setTopBarMessage("Event couldn't be approved")
            }
        }
    })
})