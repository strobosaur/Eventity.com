<?php
session_start();

// SECURITY
if(!isset($_SESSION['userID']) || !isset($_POST['view_event'])){
    header("location: index.php");
    exit();
} else {
    require_once './include/events.inc.php';
    require_once './include/login.inc.php';

    // GET EVENT & USER DATA
    $eventData = eventExists($_POST['event_ID']);
    $userData = userExists($eventData['event_userID']);
    $viewerData = userExists($_SESSION['userID']);
    $profileImg = fetchProfileImg($userData['email']);
    $viewerAccType = $viewerData['account_type'];

    $userID = $userData['userID'];
    $userUname = $userData['uname'];

    $viewerID = $viewerData['userID'];

    $eventID = $eventData["eventID"];
    $eventName = $eventData["event_name"];
    $eventText = $eventData["event_text"];

    $eventDate = $eventData["event_date"];
    $eventTime = $eventData["event_time"];

    $eventHour = explode(":", $eventTime);

    $eventAdress = $eventData["event_adress"];

    $eventLat = $eventData["event_lat"];
    $eventLng = $eventData["event_lng"];

    $eventPrice = $eventData["event_price"];
    
    if($eventPrice <= 0){
        $eventPrice = "FREE!";
    } else {
        $eventPrice .= " kr";
    }    

    $attendees = countAttendees($eventID);
    
    // CREATE EVENT VIEW HTML ELEMENT
    $eventView =
    '<container class="container "id="event-view">
        <div class="event-view-box" id="event-view-box" name="event-view-box">
            <div class="event-view-top" id="event-view-top">

                <div class="header" id="event-view-header">
                    <h2>' . $eventData["event_name"] . '</h2>
                </div>

            </div>

            <div id="event-view-main">
                <p>' . $eventText . '</p>
            </div>

            <div id="event-view-lowmid">

                <div class="event-list-low">
                    <div class="event-list-lowleft">
                        <img id="profile-img2" src="' . $profileImg . '" width="40px" height="40px">
                        <small>Created by: <br>' . $userUname . '</small>
                    </div>
                    <div class="event-list-lowmid">
                        <small>Date: ' . $eventDate . '<br>
                            Time: ' . $eventTime . '</small>
                    </div>
                    <div class="event-list-lowright">
                        <small>' . $eventAdress . '<br>
                        Price: ' . $eventPrice . '</small>
                    </div>
                </div>

                <div id="mapid">
                    <script>
                        var mymap = getMap(' . $eventLat . ',' . $eventLng . ');
                        var marker = L.marker([' . $eventLat . ',' . $eventLng . ']).addTo(mymap);
                    </script>
                </div>

                <div id="weather-box">
                </div>

            </div>

            <div id="event-view-low">
                <div class="event-view-low-left" id="event-view-low-left">';

                if (isAttending($eventID, $viewerID) == false){
                    $eventView .=
                    '<form class="form-link-btn" id="form-event-attend-btn" action="event_attend.php" method="POST">

                        <input type="hidden" value="' . $eventID . '" id="eventID" name="eventID">
                        <input type="hidden" value="' . $viewerID . '" id="attendingID" name="attendingID">

                        <button type="submit" name="event-attend-btn" id="event-attend-btn">Attend</button>
                    </form>';
                } else {
                    $eventView .=
                    '<form class="form-link-btn" id="form-remove-attend-btn" action="event_attend.php" method="POST">

                        <input type="hidden" value="' . $eventID . '" id="eventID" name="eventID">
                        <input type="hidden" value="' . $viewerID . '" id="attendingID" name="attendingID">

                        <button type="submit" name="remove-attend-btn" id="remove-attend-btn">Don´t attend</button>
                    </form>';
                }

                if(($userID === $viewerID) || ($viewerAccType > 0)){
                    $eventView .=

                    '<button type="submit" name="update-event-btn" id="update-event-btn" data-cid="' . $eventID . '">Update event info</button>';
                }

                $eventView .=                    
                '</div>
                
                <div class="event-view-low-right" id="event-view-low-right">

                    <div id="attend-info">                    
                        <button class="link-btn-small" type="submit" name="event-attendees" id="event-attendees" value="' . $eventID . '">Attending (' . $attendees . ')</button>
                    </div>';                    

                if(($userID === $viewerID) || ($viewerAccType > 0)){
                    $eventView .=

                        '<button type="submit" name="delete-event-btn" id="delete-event-btn" data-cid="' . $eventID . '">Delete event</button>';
                }

                $eventView .=
                '</div>
            </div>
        </div>
    </container>';

    // CREATE RETURN ARRAY & JSON ENCODE
    $returnArr = array("view"=>$eventView,"lat"=>$eventLat,"lng"=>$eventLng,"sdate"=>$eventDate,"hour"=>$eventHour[0], "mins"=>$eventHour[1]);
    echo json_encode($returnArr);
}
?>