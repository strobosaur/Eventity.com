<?php
session_start();

// PROTECTION
if (!isset($_POST["search"]) || !isset($_SESSION['userID'])) {
    header("Location: index.php");
    exit();
} else {

    require_once './include/events.inc.php';
    require_once './include/login.inc.php';

    $keyword = $_POST['search_text'];
    $result = searchEvents($keyword);
    if($result !== false){
        echo $result;
    } else {
        echo false;
    }
}
?>