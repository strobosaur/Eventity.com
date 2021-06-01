<?php
session_start();

if (!isset($_POST['admin_update_events']) || !($_SESSION['account_type'] >= 1)){
    header("location: index.php");
    exit();
} else {
    require_once './include/events.inc.php';
    require_once './include/login.inc.php';
    require_once './admin/include/admin.inc.php';

    $db = new SQLite3("./db/db.db");

    // AWAITING AUTHORIZATION OR ALL EVENTS
    if($_POST['awaiting_auth'] == 1){
        $result = $db->query("SELECT * 
                            FROM events 
                            WHERE adminOK = 0
                            ORDER BY eventID DESC");
    } else {
        $result = $db->query("SELECT * 
                            FROM events
                            ORDER BY eventID DESC");
    }

    // CREATE EVENT LIST
    $eventList = '';

    // LOOOP THROUGH QUERY
    while ($row = $result->fetchArray()){
        $eventList .= makeAdminListItem($row);
    }

    $db->close();

    // POST EVENT LIST
    echo $eventList;
}
?>