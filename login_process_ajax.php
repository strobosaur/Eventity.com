<?php
    session_start();
    
    if(!isset($_POST['login'])) {
        header("location: index.php");
        exit();
    } else {

        require_once './include/login.inc.php';

        // GET REGISTRATION INPUT
        $uname = $_POST['login_name'];
        $password = $_POST['login_pwd'];

        // LOGIN USER
        if(loginUser($_POST['login_name'], $_POST['login_pwd'])) {
            echo $_SESSION['profile_img'];
        } else {
            echo false;
        }
    }
?>