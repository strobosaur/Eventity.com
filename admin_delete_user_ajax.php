<?php
session_start();

if(!isset($_POST['delete-user'])){
    header("location: index.php");
    exit();
} else {
    $userData = userExists($_POST['userID']);
    $userID = $userData['userID'];

    if(deleteAccount($userID)){
        echo "true";
    } else {
        echo "false";
    }
}
?>