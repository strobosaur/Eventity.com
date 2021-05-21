<?php
    // ERROR CHECKING
    if (isset($_GET["error"])) {
        if($_GET["error"] == "") {
            ?>
            <script>setErrorFor(document.getElementById("reg_name", "Something went wrong"));</script>
            <script>setErrorFor(document.getElementById("reg_email", "Something went wrong"));</script>
            <script>setErrorFor(document.getElementById("reg_pwd1", "Something went wrong"));</script>
            <script>setErrorFor(document.getElementById("reg_pwd2", "Something went wrong"));</script>
            <?php
        } else if ($_GET['error'] == "pwd_missmatch") {
            ?>
            <script>setErrorFor(document.getElementById("reg_pwd1", "Passwords don't match"));</script>
            <script>setErrorFor(document.getElementById("reg_pwd2", "Passwords don't match"));</script>
            <?php
        } else if ($_GET['error'] == "uname_short") {
            ?>
            <script>setErrorFor(document.getElementById("reg_name", "User name too short"));</script>
            <?php
        } else if ($_GET['error'] == "email_invalid") {
            ?>
            <script>setErrorFor(document.getElementById("reg_email", "Invalid email"));</script>
            <?php
        } else if ($_GET['error'] == "uname_taken") {
            ?>
            <script>setErrorFor(document.getElementById("reg_name", "User name taken"));</script>
            <?php
        } else if ($_GET['error'] == "email_taken") {
            ?>
            <script>setErrorFor(document.getElementById("reg_email", "Email taken"));</script>
            <?php
        } else if ($_GET['error'] == "loggedin") {
            ?>
            <script>setSuccessMessage(document.getElementById("message"), "Login successful");</script>
            <?php
        }
    }
?>