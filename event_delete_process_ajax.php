<?php
    session_start();

    if(!isset($_POST['delete-event'])){
        header("location: index.php");
        exit();
    } else {
        require_once './include/events.inc.php';

        if(deleteEvent($_POST['eventID'])){
            echo "true";
        } else {
            echo "false";
        }
    }
?>