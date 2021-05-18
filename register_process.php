<?php
    if(!isset($_POST['register'])) {
        header("location: index.php");
        exit();
    } else {

        require_once './include/login.inc.php';

        // GET REGISTRATION INPUT
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        // REGISTER USER
        if(registerUser($fname,$lname,$uname,$email,$password1,$password2)) {
            header("location: register_success.php");
            exit();
        } else {
            header("location: register.php?error=regfailed");
            exit();
        }
    }
?>
