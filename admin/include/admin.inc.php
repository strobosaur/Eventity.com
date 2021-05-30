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
        <div class="event-box-admin" id="event-box">
        <button class="view-event-btn" type="submit" data-cid="' . $evtID . '" name="view-event-btn" id="view-event-btn">' . $evtName . '</button>

            <small>Host: ' . $evtUname . '</small>
            <small>Time: ' . $evtTime . '</small>
            <small>Price: ' . $evtPrice . '</small>
        </div>
        <div class="event-box-admin2" id="event-box">
            <button class="event-admin-ok-btn" type="submit" id="link-btn-small" data-cid="'. $evtID .'">Approve</button>
            <button class="event-admin-deny-btn" type="submit" id="link-btn-small" data-cid="'. $evtID .'">Delete</button>
        </div>
    </container>';

    // POST ITEM
    echo $event;

}

?>