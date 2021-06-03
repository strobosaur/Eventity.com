<?php
session_start();

// PROTECTION
if(!isset($_POST['get_menu'])){
    header("location: index.php");
    exit();
} else {
    require_once './include/login.inc.php';

    $profileImg = '';

    $nav_menu =
    '<ul>';

        // DETERMINE MENU ALTERNATIVES BY USER TYPE
        if ((isset($_SESSION['userID'])) && ($_SESSION['account_type'] >= 1)){
            $userData = userExists($_SESSION['userID']);
            $profileImg = fetchProfileImg($userData['email']);

            $nav_menu .=
                '<li><a id="menu_profile" href="index.php">' . $_SESSION['user_uname'] . '</a></li>
                <li><a id="menu_home" href="index.php">Home</a></li>
                <li><a id="menu_search" href="index.php">Search</a></li>
                <li><a id="menu_admin" href="index.php">Admin</a></li>
                <li><a id="menu_logout" href="logout_process.php">Log out</a></li>';
        } else if (isset($_SESSION['userID'])) {
            $userData = userExists($_SESSION['userID']);
            $profileImg = fetchProfileImg($userData['email']);

            $nav_menu .=
                '<li><a id="menu_profile" href="index.php">' . $_SESSION['user_uname'] . '</a></li>
                <li><a id="menu_home" href="index.php">Home</a></li>
                <li><a id="menu_search" href="index.php">Search</a></li>
                <li><a id="menu_logout" href="logout_process.php">Log out</a></li>';
        } else {
            $nav_menu .=
                '<li><a id="menu_login" href="index.php">Login</a></li>
                <li><a id="menu_register" href="index.php">Register</a></li>';
        }

    $nav_menu .=
    '</ul>';

    $returnArr = array("menu"=>$nav_menu,"img"=>$profileImg);

    echo json_encode($returnArr);
}
?>