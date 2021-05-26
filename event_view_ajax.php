<?php
session_start();

if(!isset($_SESSION['userID']) || !isset($_POST['view_event'])){
    header("location: index.php");
    exit();
} else {
    require_once './include/events.inc.php';
    require_once './include/login.inc.php';

    $eventData = eventExists($_POST['event_ID']);
    $userData = userExists($eventData['event_userID']);
    $viewerData = userExists($_SESSION['userID']);

    $userID = $userData['userID'];
    $userUname = $userData['uname'];

    $eventID = $eventData["eventID"];
    $eventName = $eventData["event_name"];
    $eventText = $eventData["event_text"];
    $eventDate = $eventData["event_date"];
    $eventTime = $eventData["event_time"];
    $eventEdate = $eventData["event_enddate"];
    $eventEtime = $eventData["event_endtime"];
    $eventAdress = $eventData["event_adress"];
    $eventZip = $eventData["event_zip"];
    $eventCity = $eventData["event_city"];
    $eventPrice = $eventData["event_price"];
    
    if($eventPrice <= 0){
        $eventPrice = "FREE!";
    } else {
        $eventPrice .= " kr";
    }
    
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
                <small>Starts: ' . $eventDate . ', ' . $eventTime . '</small>
                <small>Location: ' . $eventAdress . ', ' . $eventZip . ', ' . $eventCity . '</small>
                <small>Host: ' . $userUname . '</small>
                <small>Price: ' . $eventPrice . '</small>
            </div>

            <div id="event-view-low">
                <form class="form-link-btn" id="form-event-attend-btn" action="event_attend.php" method="POST">
                    <input type="hidden" value="' . $eventID . '" id="eventID name="eventID">
                    <input type="hidden" value="' . $viewerData["userID"] . '" id="attendingID" name="attendingID">
                    <button class="link-btn" type="submit" name="event-attend-btn" id="event-attend-btn">Attend</button>
                </form>
            </div>            

        </div>
    </container>';

    echo $eventView;
}
?>