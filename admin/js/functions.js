//FUNCTION GET ADMIN EVENT LIST
function updateEventListAdmin(auth){
    $.ajax({
        url: 'admin_event_list.php',
        type: 'POST',
        data: {
            'admin_update_events': 1,
            'awaiting_auth': auth,
        },
        success: function(response){
            $("#event-list").empty();
            if (auth === 1){
                $("#event-list").append('<div class="container"><div class="header"><h2>Events awaiting approval</h2></div></div>');
            } else {
                $("#event-list").append('<div class="container"><div class="header"><h2>All events</h2></div></div>');
            }
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
            $.getScript("./admin/js/admin_side_menu_actions.js");
        }
    });
}

// FUNCTION GET ADMIN USER LIST
function getUserListAdmin(){
    $.ajax({
        url: 'admin_user_list_ajax.php',
        type: 'POST',
        data: {
            'admin_user_list': 1,
        },
        success: function(response){
            $("#event-list").empty();
            $("#event-list").append(response);
            $.getScript("./admin/js/admin_user_list_actions.js");
        }
    });
}

// FUNCTION GET ADMIN USER LIST
function getNewsUpdateAdmin(){
    $.ajax({
        url: 'admin_news_update_ajax.php',
        type: 'POST',
        data: {
            'update-msg': 1,
        },
        success: function(response){
            $("#event-list").empty();
            $("#event-list").append(response);
            $.getScript("./admin/js/admin_update_msg_actions.js");
        }
    });
}