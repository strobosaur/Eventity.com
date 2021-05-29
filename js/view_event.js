// SEND POST TO DATABASE
$('#form-view-event-btn').submit(function(e) {
    e.preventDefault();
    var eventID = $("#eventID").val();

    $.ajax({
        url: 'event_view_ajax.php',
        type: 'POST',
        dataType: 'json',
        data: {
            'view_event': 1,
            'event_ID': eventID,
        },
        success: async function(response){
            clearInterval(eventListUpdate);

            // APPEND EVENT VIEW
            $('#event-list').empty();
            $('#event-list').append(response.view);

            // GET WEATHER DATA
            var weatherArr = await getWeatherDate(response.lat,response.lng,response.sdate,response.hour);
            $("#event-view-lowmid").append('<div id="weather-box"></div>');

            // IS THERE WEATHER DATA FOR THE DATE/TIME OF THIS EVENT?
            if (weatherArr !== false){
                $("#weather-box").append("<h4>Expected weather in this location on " + response.sdate + " around " + response.hour + ":" + response.mins + "</h4><br>");
                $("#weather-box").append("<p>Temperature: " + weatherArr.temp + " °C<br>Wind: " + weatherArr.wind + " m/s<br>Rain: " + weatherArr.rain + " mm<br>In general: " + weatherArr.desc + "</p>");
            } else {
                $("#weather-box").append("<h4>Expected weather in this location on " + response.sdate + " around " + response.hour + ":" + response.mins + "</h4><br>");
                $("#weather-box").append("<p>Too early to tell...</p>");
            }
        }
    });
});