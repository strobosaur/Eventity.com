<?php
session_start();

// MAKE SURE USER IS LOGGED IN / NO FOUL PLAY
if((!isset($_SESSION['userID'])) || (!isset($_POST['update']))) {
    header("location: index.php");
    exit();
} else {

    require_once './include/login.inc.php';

    $userID = $_SESSION['userID'];

    // INPUT VALIDATION & FORMATTING

    // CHECK OLD PASSWORD
    if(!passwordMatchesDB($userID, $_POST['password0'])){
        header("location: index.php?error=wrong_pwd");
        exit();
    }

    // CHECK NEW PASSWORD MATCH
    if($_POST['password1'] !== $_POST['password2']){
        header("location: index.php?error=pwd_missmatch");
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
        header("location: index.php?error=upd_success");
        exit();
    } else {
        header("location: index.php?error=upd_failed");
        exit();
    }
}
?>