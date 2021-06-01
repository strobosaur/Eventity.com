<?php
// MAKE ADMIN EVENT LIST ITEM
function makeAdminListItem($row){

    $creator = userExists($row['event_userID']);
    $profileImg = fetchProfileImg($creator['email']);

    $evtID = $row['eventID'];
    $evtUname = $creator['uname'];

    $evtName = $row['event_name'];
    $evtTime = $row['event_time'];
    $evtPrice = $row['event_price'];
    $evtDate = $row['event_date'];
    $evtCity = $row['event_city'];

    // CREATE EVENT ITEM
    $event =
    '<container class="container">
        <div class="event-box-admin" id="event-box">
        <button class="view-event-btn" type="submit" data-cid="' . $evtID . '" name="view-event-btn" id="view-event-btn">' . $evtName . '</button>';

        $event .=
        '<div class="event-list-low">
            <div class="event-list-lowleft">
                <img id="profile-img2" src="' . $profileImg . '" width="40px" height="40px">
                <small>Created by: <br>' . $evtUname . '</small>
            </div>
            <div class="event-list-lowmid">
                <small>Date: ' . $evtDate . '<br>
                    Time: ' . $evtTime . '</small>
            </div>
            <div class="event-list-lowright">
                <small>' . $evtCity . '<br>
                Price: ' . $evtPrice . '</small>
            </div>
        </div>
        </div>
        <div class="event-box-admin2" id="event-box">
            <button class="event-admin-ok-btn" type="submit" id="link-btn-small" data-cid="'. $evtID .'"><img id="img-approve" src="./img/check3.png" width="32px" height="32px"></button>
            <button class="event-admin-deny-btn" type="submit" id="link-btn-small" data-cid="'. $evtID .'"><img id="img-deny" src="./img/cross3.png" width="32px" height="32px"></button>
        </div>
    </container>';

    // POST ITEM
    echo $event;
}

// FUNCTION APPROVE EVENT
function approveEvent($eventID){
    $db = new SQLite3("./db/db.db");
    $sql = "UPDATE 'events'
            SET adminOK = :adminOK
            WHERE eventID = :eventID";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":eventID", $eventID, SQLITE3_INTEGER);
    $stmt->bindValue(":adminOK", 1, SQLITE3_INTEGER);
    if($stmt->execute()){
        $db->close();
        return true;
    } else {
        $db->close();
        return false;
    }
}

?>