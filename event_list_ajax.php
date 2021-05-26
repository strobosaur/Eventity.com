<?php
session_start();

if (!isset($_POST['update_events'])){
    header("location: index.php");
    exit();
} else {
    require_once './include/events.inc.php';
    require_once './include/login.inc.php';

    $db = new SQLite3("./db/db.db");
    $result = $db->query("SELECT * FROM events ORDER BY eventID DESC");

    // CREATE EVENT LIST
    $eventList = '';

    // LOOOP THROUGH QUERY
    while ($row = $result->fetchArray()){
        $eventList .= makeEventListItem($row);
    }

    // POST EVENT LIST
    echo $eventList;
}
?>