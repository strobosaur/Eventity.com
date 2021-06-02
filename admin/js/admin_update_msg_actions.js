// ADMIN UPDATE MESSAGE
$("#news-msg-form").submit(function(e){
    e.preventDefault();
    var message = $("#new_msg").val();

    $.ajax({
        url: "admin_news_process_ajax.php",
        type: "POST",
        data: {
            "update_msg": 1,
            "new_msg": message,
        },
        success: function(response){
            if(response != "false"){
                $("#new-msg").val('');
                setTopBarMessage("New message posted");
            } else {
                setTopBarMessage("Message failed to post")
            }
        }
    })
})