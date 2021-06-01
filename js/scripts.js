// FUNCTION SET FORM FIELD ERROR
function setErrorForm(input, msg) {
    const formControl = input.parentElement;
    const small = formControl.querySelector('small');
    
    small.innerText = msg;
    formControl.className = 'form-control error';
}
  
// FUNCTION SET FORM FIELD SUCCESS
function setSuccessForm(input) {
    const formControl = input.parentElement;  
    formControl.className = 'form-control success';
}

// FUNCTION REGISTRATION SUCCESSFUL
function setSuccessMessage(input, msg){
    const elementControl = input.parentElement;
    const h4 = elementControl.querySelector('h4');

    h4.innerText = msg;
    elementControl.className = 'success-message success';
}

// FUNCTION REGISTRATION SUCCESSFUL
function setErrorMessage(input, msg){
    const elementControl = input.parentElement;
    const h4 = elementControl.querySelector('h4');

    h4.innerText = msg;
    elementControl.className = 'success-message error';
}

// FUNCTION UPDATE EVENT LIST
function updateEventListAjax(){
    $.ajax({
        url: 'event_list_ajax.php',
        type: 'POST',
        data: {
            'update_events': 1,
        },
        success: function(response){
            $("#event-list").empty();
            $("#event-list").append(response);
            $.getScript("./js/view_event.js");
        }
    });
}

// FUNCTION GET LOGIN FORM
function getLoginAjax(){
    $.post("login_ajax.php", function(data){
        $("#left-field").empty();
        $("#left-field").append(data);
        $.getScript("./js/login.js");
    });
}

// FUNCTION GET LOGIN FORM
function getEventViewAjax(eventID){
    $.ajax({
        url: 'event_view_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'view_event': 1,
            'event_ID': eventID,
        },
        success: async function(response){

            // APPEND EVENT VIEW
            $('#event-list').empty();
            $('#event-list').append(response.view);
            $.getScript('./js/attend_event.js');
            $.getScript('./js/weather.js');

            // GET WEATHER DATA
            var weatherArr = await getWeatherDate(response.lat,response.lng);
            $("#event-view-lowmid").append('<div id="weather-box"></div>');

            // IS THERE WEATHER DATA FOR THE DATE/TIME OF THIS EVENT?
            if (weatherArr !== false){
                $("#weather-box").append("<h4>Expected weather at this location on " + response.sdate + " around " + response.hour + ":" + response.mins + "</h4><br>");
                $("#weather-box").append("<p>Temperature: " + weatherArr.temp + " °C<br>Feels like: " + weatherArr.temp_app + " °C<br>Wind: " + weatherArr.wind + " m/s<br>Rain: " + weatherArr.rain + " mm<br>In general: " + weatherArr.desc + "</p>");
            } else {
                $("#weather-box").append("<h4>Expected weather in this location on " + response.sdate + " around " + response.hour + ":" + response.mins + "</h4><br>");
                $("#weather-box").append("<p>Too early to tell...</p>");
            }
        }
    });
}

// FUNCTION GET REGISTER FORM
function getRegisterAjax(){
    $.post("register_ajax.php", function(data){
        $("#left-field").empty();
        $("#left-field").append(data);
    });
}

// FUNCTION SEARCH POST FORM
function getProfileAjax(){
    $.ajax({
        url: 'profile_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'get_profile': 1,
        },
        success: function(response){
            stopUpdateEvents();
            $('#left-field').empty();
            $('#left-field').append(response.left);
            $('#event-list').empty();
            $('#event-list').append(response.right);
            $.getScript("./js/profile_img_update.js");
            $.getScript("./js/profile_img_delete.js");
        }
    });
}

// FUNCTION GET REGISTER FORM
function getSideMenuAjax(){
    
    $.ajax({
        url: 'side_menu_ajax.php',
        type: 'POST',
        data: {
            'get_side_menu': 1,
            'read-message': 1,
        },
        success: function(response){
            $("#left-field").empty();
            $("#left-field").append(response);
            $.getScript("./js/side_menu_action.js");
        }
    });
}

// FUNCTION GET MENU
function getMenuAjax(){
    $.ajax({
        url: './include/views/nav_menu_ajax.php',
        type: 'POST',
        data: {
            'get_menu': 1,
        },
        success: function(response){
            $("#header-mid").empty();
            $("#header-mid").append(response);
            $.getScript("./js/nav_menu_action.js");
        }
    });
}

// SET MESSAGE
function setTopBarMessage(msg){
    $("#message-bar").empty();
    $("#message-bar").append("<div class='fade-out' id='fade-out'><p class='message' id='top-msg'>" + msg + "</p></div>");
}

// FUNCTION CLEAR UPDATES
function stopUpdateEvents(){
    clearInterval(eventListUpdate);
}

// FUNCTION START UPDATING POSTS
function startUpdateEvents(){
    clearInterval(eventListUpdate);
    eventListUpdate = setInterval(updateEventListAjax, 5000);
}