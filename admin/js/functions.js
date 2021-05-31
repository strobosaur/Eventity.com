//FUNCTION GET ADMIN EVENT LIST
function updateEventListAdmin(){
    $.ajax({
        url: 'admin_event_list.php',
        type: 'POST',
        data: {
            'admin_update_events': 1,
        },
        success: function(response){
            $("#event-list").empty();
            $("#event-list").append('<div class="container"><div class="header"><h2>Events awaiting approval</h2></div></div>');
            $("#event-list").append(response);
            $.getScript("./js/view_event.js");
            $.getScript("./admin/js/admin_event_actions.js");
        }
    });
}

// FUNCTION GET ADMIN SIDE MENU
function getSideMenuAdmin(){
    $.ajax({
        url: 'admin_side_menu.php',
        type: 'POST',
        data: {
            'admin_side_menu': 1,
        },
        success: function(response){
            $("#left-field").empty();
            $("#left-field").append(response);
            $.getScript("./admin/js/admin_event_list.js");
            $.getScript("./admin/js/admin_user_list.js");
            $.getScript("./admin/js/admin_event_actions.js");
        }
    });

}