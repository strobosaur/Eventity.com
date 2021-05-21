<?php
    if(!isset($_POST['register'])) {
        header("location: index.php");
        exit();
    } else {

        require_once './include/login.inc.php';

        // GET REGISTRATION INPUT
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        // REGISTER USER
        if(registerUser($uname,$email,$password1,$password2)) {
            header("location: register_success.php");
            exit();
        } else {
            header("location: register.php?error=regfailed");
            exit();
        }
    }
?>
