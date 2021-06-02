// WAIT FOR DOCUMENT TO LOAD
$(document).ready(function(){

    // SEARCH POST IN DATABASE
    $('#form-search').submit(function(e) {
        e.preventDefault();

        var keyword = $('#search_text').val();

        $.ajax({
            url: 'search_process_ajax.php',
            type: 'POST',
            data: {
                'search': 1,
                'search_text': keyword,
            },
            success: function(response){
                if(response != ''){
                    stopUpdateEvents();
                    setTopBarMessage("Search successful");
                    $('#search_text').val('');
                    $("#event-list").empty();
                    $("#event-list").append(response);
                    $.getScript("./js/view_event.js");
                } else {
                    setTopBarMessage("Search did not return any results");
                }
            }
        });
    });
})