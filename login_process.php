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

        // REGISTER USER
        if(loginUser($uname, $password)) {
            header("location: index.php?error=regsuccess");
            exit();
        } else {
            header("location: index.php?error=regfailed");
            exit();
        }
    }
?>