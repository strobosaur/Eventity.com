<?php

require_once './include/events.inc.php';
require_once './include/login.inc.php';

$db = new SQLite3("./db/db.db");
$result = $db->query("SELECT * FROM events ORDER BY eventID DESC");

while ($row = $result->fetchArray()){

    $creator = userExists($row['event_userID']);

    $evtID = $row['eventID'];
    $evtUname = $creator['uname'];
    $evtName = $row['event_name'];
    $evtText = $row['event_text'];
    $evtCity = $row['event_city'];
    $evtDate = $row['event_date'];
    $evtTime = $row['event_time'];
    $evtPrice = $row['event_price'];

    ?>
    <container class="container">
        <div class="event-box" id="event-box">   

            <form class="form-link-btn" id="form-view-event-btn" action="event_view.php" method="POST">
                <input type="hidden" value="<?=$evtID?>" name="eventID">
                <button class="link-btn" type="submit" name="view-event-btn" id="view-event-btn"><?=$evtName?></button>
            </form>
            <p><?=$evtText?></p>
            <small>Host: <?=$evtUname?></small>
            <small>Date: <?=$evtDate?></small>
            <small>Time: <?=$evtTime?></small>
            <small>Location: <?=$evtCity?></small>
            <small>Price: <?=$evtPrice?></small>

        </div>
    </container>
<?php
}
?>