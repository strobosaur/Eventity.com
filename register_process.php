<?php
session_start();

    if(!isset($_POST['register'])) {
        header("location: index.php");
        exit();
    } else {

        require_once './include/login.inc.php';

        // GET REGISTRATION INPUT
        $uname = $_POST['reg_name'];
        $email = $_POST['reg_email'];
        $password1 = $_POST['reg_pwd1'];
        $password2 = $_POST['reg_pwd2'];

        // REGISTER USER
        if(registerUser($uname,$email,$password1,$password2)) {
            header("location: index.php?error=regsuccess");
            exit();
        } else {
            header("location: index.php?error=regfailed");
            exit();
        }
    }
?>
