<?php
    if(!isset($_POST['register'])) {
        header("location: index.php");
        exit();
    } else {

        require_once './include/login.inc.php';

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['uname'];
        $email = $_POST['email'];
        $pnr = $_POST['pnr'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        
        $street = $_POST['street'];
        $zip = $_POST['zip'];
        $city = $_POST['city'];
        $cellnr = $_POST['cellnr'];

        if(registerUser($fname,$lname,$uname,$email,$pnr,$password1,$password2)) {

            $result = userExists($email);

            if(registerUserAdress($result['userID'],$street,$zip,$city,$cellnr)){
                
            }
        }
    }
?>
