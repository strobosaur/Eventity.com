<?php
session_start();

// MAKE SURE USER IS LOGGED IN / NO FOUL PLAY
if(!isset($_SESSION['userID'])) {
    header("location: index.php");
    exit();
} else {

    require_once './include/login.inc.php';

    // ADRESS UPDATE
    if (isset($_POST['upd_adress'])) {
        if (registerUserAdress($_SESSION['userID'], $_POST['street'], $_POST['zip'], $_POST['city'])) {
            header("location: profile.php?error=upd_adress_success");
            exit();
        } else {
            header("location: profile.php?error=upd_adress_failed");
            exit();
        }
    }

    if (isset($_POST['upd_profile'])){

        $userID = $_SESSION['userID'];

        // INPUT VALIDATION & FORMATTING

        // CHECK OLD PASSWORD
        if(!passwordMatchesDB($userID, $_POST['password0'])){
            header("profile.php?error=wrong_pwd");
            exit();
        }

        // CHECK NEW PASSWORD MATCH
        if(passwordMatch($_POST['password1'],$_POST['password2'])){
            header("location: profile.php?error=pwd_missmatch");
            exit();
        }

        // FIRST NAME
        if (empty($_POST['fname'])) {
            $fname = $_SESSION['user_fname'];
        } else {
            $fname = $_POST['fname'];
        }

        // LAST NAME
        if (empty($_POST['lname'])) {
            $lname = $_SESSION['user_lname'];
        } else {
            $lname = $_POST['lname'];
        }

        // USER NAME
        if (empty($_POST['uname'])) {
            $uname = $_SESSION['user_uname'];
        } else {
            $uname = $_POST['uname'];
        }

        // EMAIL
        if (empty($_POST['email'])) {
            $email = $_SESSION['user_email'];
        } else {
            $email = $_POST['email'];
        }

        // PASSWORD
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        // UPDATE USER DATA IN DATABASE
        if (updateUserProfile($userID,$fname,$lname,$uname,$email,$password1,$password2)) {
            header("location: profile.php?error=profile_upd_success");
            exit();
        } else {
            header("location: profile.php?error=profile_upd_failed");
            exit();
        }
    }
}
?>