// WAIT FOR DOCUMENT LOAD
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

    // NAVIGATION MENU SEARCH
    $('#menu_search').click(function(e) {
        e.preventDefault();
        getSearchAjax();
        startUpdateEvents();
    })

    // NAVIGATION MENU LOGOUT
    $('#menu_logout').click(function(e) {
        e.preventDefault();
        $.post("logout_process.php", function(){
            
            getMenuAjax();
            getLoginAjax();            
            updateEventListAjax();
            startUpdateEvents();
            setTopBarMessage("Logged out")
        })
    })

    // NAVIGATION MENU LOGIN
    $('#menu_home').click(function(e) {
        e.preventDefault();
        getSideMenuAjax();
        updateEventListAjax();
        startUpdateEvents();
    })
    
    // NAVIGATION MENU PROFILE
    $('#menu_profile').click(function(e) {
        e.preventDefault();
        stopUpdateEvents();
        getProfileAjax();        
    })
    
    // NAVIGATION MENU PROFILE
    $('#menu_admin').click(function(e) {
        e.preventDefault();
        stopUpdateEvents();
        updateEventListAdmin(1);
        getSideMenuAdmin();
    })
});