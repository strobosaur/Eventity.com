// WAIT FOR DOCUMENT TO LOAD
$(document).ready(function(){

    // ADMIN PROMOTE USER TO ADMIN
    $(".user-admin-btn").click(function(e){
        e.preventDefault;
        var cid = $(this).data('cid');

        $.ajax({
            url: "admin_promote_user_ajax.php",
            type: "POST",
            data: {
                "promote-user": 1,
                "userID": cid,
                "account_type": 2,
            },
            success: function(response){
                if(response != "false"){
                    getUserListAdmin();
                    setTopBarMessage("User promoted to admin");
                } else {
                    setTopBarMessage("Couldn't change account type");
                }
            }
        })
    })

    // ADMIN PROMOTE USER TO MODERATOR
    $(".user-moderator-btn").click(function(e){
        e.preventDefault;
        var cid = $(this).data('cid');

        $.ajax({
            url: "admin_promote_user_ajax.php",
            type: "POST",
            data: {
                "promote-user": 1,
                "userID": cid,
                "account_type": 1,
            },
            success: function(response){
                if(response != "false"){
                    getUserListAdmin();
                    setTopBarMessage("User promoted to moderator");
                } else {
                    setTopBarMessage("Couldn't change account type");
                }
            }
        })
    })

    // ADMIN MAKE USER ACCOUNT STANDARD
    $(".user-standard-btn").click(function(e){
        e.preventDefault;
        var cid = $(this).data('cid');

        $.ajax({
            url: "admin_promote_user_ajax.php",
            type: "POST",
            data: {
                "promote-user": 1,
                "userID": cid,
                "account_type": 0,
            },
            success: function(response){
                if(response != "false"){
                    getUserListAdmin();
                    setTopBarMessage("User account changed to standard");
                } else {
                    setTopBarMessage("Couldn't change account type");
                }
            }
        })
    })

    // ADMIN MAKE USER ACCOUNT STANDARD
    $(".user-delete-btn").click(function(e){
        e.preventDefault;
        var cid = $(this).data('cid');

        $.ajax({
            url: "admin_delete_user_ajax.php",
            type: "POST",
            data: {
                "delete-user": 1,
                "userID": cid,
            },
            success: function(response){
                if(response != "false"){
                    getUserListAdmin();
                    setTopBarMessage("User account deleted");
                } else {
                    setTopBarMessage("Couldn't delete account");
                }
            }
        })
    })
})