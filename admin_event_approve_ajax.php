<?php
session_start();

if(!isset($_POST['event-approve'])){
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