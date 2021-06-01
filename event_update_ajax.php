<?php
session_start();

// SECURITY
if(!isset($_POST['create-event']) || !isset($_SESSION['userID'])){
    header("location: index.php");
    exit();
} else {

// CREATE EVENT BOX
$eventCreateBox =
'<container class="container "id="create-event">
    <div id="event-view-box">

        <div class="header">
            <h2>Create new event</h2>
        </div>

        <form class="form-event" id="create-event-form" name="create-event-form" onsubmit="" action="event_create_process.php" method="post">


            <div class="form-control">
            <label>Event name</label>
            <input type="text" placeholder="event name" name="evt_name" id="evt_name" required>
            <span></span>
            <small>Error message</small>
            </div>

            <div class="form-control">
            <label>Describe your event</label>
            <textarea placeholder="belching contest, backyard fish sale, beard seminar..." name="evt_text" id="evt_text" maxlength="1000" required></textarea>
            <span></span>
            <small>Error message</small>
            </div>

            <div class="form-left">

                <div class="form-control">
                <label>Start date</label>
                <input type="date" name="evt_sdate" id="evt_sdate" min="' . date("Y-m-d") . '" required>
                <span></span>
                <small>Error message</small>
                </div>                    

                <div class="form-control">
                <label>Adress</label>
                <input type="text" placeholder="Partystreet 123" name="evt_adress" id="evt_adress">
                <small>Error message</small>
                </div>

                <div class="form-control">
                <label>Price</label>
                <input type="number" placeholder="100" name="evt_price" id="evt_price">
                <small>Error message</small>
                </div>

            </div>

            <div class="form-right">

                <div class="form-control">
                <label>Start time</label>
                <input type="time" name="evt_stime" id="evt_stime" required>
                <span></span>
                <small>Error message</small>
                </div>

                <div class="form-control">
                <label id="indoors-label">Indoors</label>
                <input type="checkbox" name="evt_indoors" id="evt_indoors" value="1">
                <label for="evt_indoors"></label>
                <small>Error message</small>
                </div>

            </div>

            <input type="hidden" name="evt_lat" id="evt_lat" value="59.8586">
            <input type="hidden" name="evt_lng" id="evt_lng" value="17.6389">

            <div id="mapid">
                <script>
                    var mymap = getMap();
                    var marker = L.marker([59.8586, 17.6389]).addTo(mymap);

                    function onMapClick(e) {
                        var coord = e.latlng;
                        var lat = coord.lat;
                        var lng = coord.lng;

                        if (marker != undefined) {
                            mymap.removeLayer(marker);
                        };

                        marker = L.marker([lat, lng]).addTo(mymap);
                        console.log("You clicked the map at " + e.latlng);

                        $("#evt_lat").val(lat);
                        $("#evt_lng").val(lng);
                    }

                    mymap.on("click", onMapClick);
                </script>
            </div>
        
            <button type="submit" name="create" id="create">Create event</button>

        </form>
    </div>
</container>';

echo $eventCreateBox;

}

?>