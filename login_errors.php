<?php
    // ERROR CHECKING
    if (isset($_GET['error'])) {
        if($_GET['error'] == "") {
            ?>
            <script>setErrorFor(document.getElementById("login_name", "Något gick fel"));</script>
            <script>setErrorFor(document.getElementById('login_pwd', "Något gick fel"));</script>
            <?php
        } else if ($_GET['error'] == "nouser") {
            ?>
            <script>setErrorFor(document.getElementById('login_email', "No account found"));</script>
            <?php
            //echo "<p>Kontot finns inte</p>";
        } else if ($_GET['error'] == "wrongpwd") {
            ?>
            <script>setSuccessFor(document.getElementById('login_email'));</script>
            <script>setErrorFor(document.getElementById('login_pwd', "Wrong password"));</script>
            <?php
        } else if ($_GET['error'] == "loggedin") {
            ?>
            <script>setSuccessMessage(document.getElementById('message'), "Login successful");</script>
            <?php
        }
    }
?>