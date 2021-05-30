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
        <div class="event-box" id="event-box">
        <button class="view-event-btn" type="submit" data-cid="' . $evtID . '" name="view-event-btn" id="view-event-btn">' . $evtName . '</button>

            <small>Host: ' . $evtUname . '</small>
            <small>Time: ' . $evtTime . '</small>
            <small>Price: ' . $evtPrice . '</small>
        </div>
    </container>';

    // POST ITEM
    echo $event;

}

?>