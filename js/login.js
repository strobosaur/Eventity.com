// LOGIN HANDLING
$('#login-form').submit(function(e){
    e.preventDefault();

    var uname = $("#login_name").val();
    var pwd = $("#login_pwd").val();

    $.ajax({
        url: 'login_process_ajax.php',
        type: 'POST',
        data: {
            'login': 1,
            'login_name': uname,
            'login_pwd': pwd,
        },
        success: function(response){
            if (response !== false) {
                getSideMenuAjax();
                getMenuAjax();
                updateEventListAjax();
                setTopBarMessage("Login successful")
            } else {
                setTopBarMessage("Login failed")
            }
        }
    })
})