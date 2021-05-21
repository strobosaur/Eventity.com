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

// FUNCTION GET LOGIN FORM
function getLoginAjax(){
    $.post("login_ajax.php", function(data){
        $("#left-field").empty();
        $("#left-field").append(data);
    });
}

// FUNCTION GET REGISTER FORM
function getRegisterAjax(){
    $.post("register_ajax.php", function(data){
        $("#left-field").empty();
        $("#left-field").append(data);
    });
}

// WAIT FOR PAGE LOAD
$(document).ready(function(){

    // NAVIGATION MENU REGISTER
    $('#menu_register').click(function(e) {
        e.preventDefault();
        getRegisterAjax();
    })

    // NAVIGATION MENU LOGIN
    $('#menu_login').click(function(e) {
        e.preventDefault();
        getLoginAjax();
    })
})