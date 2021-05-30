<?php
// MAKE ADMIN EVENT LIST ITEM
function makeAdminListItem($row){

    $creator = userExists($row['event_userID']);

    $evtID = $row['eventID'];
    $evtUname = $creator['uname'];
    $evtName = $row['event_name'];
    $evtTime = $row['event_time'];
    $evtPrice = $row['event_price'];

    // CREATE EVENT ITEM
    $event =
    '<container class="container">
        <div class="event-box" id="event-box">';   

        if(isset($_SESSION["userID"])){
            $event .=
            '<form class="form-link-btn" id="admin-view-event-btn" name="admin-view-event-btn" action="event_view.php" method="POST">
                <input type="hidden" value="' . $evtID . '" id="eventID" name="eventID">
                <button class="link-btn" type="submit" name="admin-event-btn" id="admin-event-btn">' . $evtName . '</button>
            </form>';
        } else {
            $event .= 
            '<div class="event-item-header" id="event-item-header">
                <h3>' . $evtName . '</h3>
            </div>';
        }

        $event .=
            '<small>Host: ' . $evtUname . '</small>
            <small>Time: ' . $evtTime . '</small>
            <small>Price: ' . $evtPrice . '</small>
        </div>
    </container>';

    // POST ITEM
    echo $event;

}

?>