<?php
session_start();

// SECURITY
if(!isset($_POST['get_side_menu']) || !isset($_SESSION['userID'])){
    header("location: index.php");
    exit();
} else {

    require_once './include/login.inc.php';

    $userData = userExists($_SESSION['userID']);
    $profileImg = $userData['profile_img'];
    $uname = $userData['uname'];

    // MAKE SIDE MENU HTML
    $sideMenu =
    '<div class="container" id="menu-container">

        <div class="header" id="menu-header">
            <h2>Menu</h2>
        </div> 

        <button type="submit" name="create-event-btn" id="create-event-btn">Create new event</button>
    </div>';

    $sideMenu .=
    '<div class="container" id="news-container">

        <div class="header" id="news-header">
            <h2>Site news</h2>
        </div>
        
        <div class="news-box" id="news-box">
            <p>Under construction, meny exciting functions and breaches of your private data will be coming shortly!</p>
        </div>

    </div>';

    echo $sideMenu;
}
?>