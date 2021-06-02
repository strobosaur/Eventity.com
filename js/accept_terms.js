// WAIT FOR DOCUMENT TO LOAD
$(document).ready(function(){

    // CHECKBOX CHECKED
    $("#check-terms").click(function(){
        if($(this).prop("checked") == true){
            document.getElementById("register").style.display = "block";
        }else{
            document.getElementById("register").style.display = "none";
        }
    });

    // DISPLAY TERMS AND CONDITIONS
    $("#terms-conditions").click(function(e){
        e.preventDefault();
        $.ajax({
            url: "register_terms_ajax.php",
            type: "POST",
            data:{
                "get-terms": 1,
            },
            success: function(response){
                stopUpdateEvents();
                $("#event-list").empty();
                $("#event-list").append(response);
            }
        })
    });
})