<?php
session_start();

// SECURITY
if(!isset($_POST['attend-event']) || !isset($_SESSION['userID'])){
    header("location: index.php");
    exit();
} else {
    require_once './include/events.inc.php';

    if(addAttendee($_POST['eventID'], $_POST['userID'])){
        echo true;
    } else {
        echo false;
    }
}

?>