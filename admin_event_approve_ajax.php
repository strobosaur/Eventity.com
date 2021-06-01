<?php

if(!isset($_POST['approve-event'])){
    header("location: index.php");
    exit();
} else {

    require_once './admin/include/admin.inc.php';

    $eventID = $_POST['eventID'];
    if(approveEvent($eventID)){
        echo "true";
    } else {
        echo "false";
    }
}
?>