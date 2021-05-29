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


// FUNCTION UPDATE POSTS
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

// FUNCTION GET REGISTER FORM
function getRegisterAjax(){
    $.post("register_ajax.php", function(data){
        $("#left-field").empty();
        $("#left-field").append(data);
    });
}

// FUNCTION GET REGISTER FORM
function getSideMenuAjax(){
    $.post("side_menu_ajax.php", function(data){
        $("#left-field").empty();
        $("#left-field").append(data);
    });
}

// SET MESSAGE
function setTopBarMessage(msg){
    $("#message-bar").empty();
    $("#message-bar").append("<div class='fade-out' id='fade-out'><p class='message' id='top-msg'>" + msg + "</p></div>");
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
            $("#nav-menu").empty();
            $("#nav-menu").append(response);
            $.getScript("./js/nav_menu_action.js");
        }
    });
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