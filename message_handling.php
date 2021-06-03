<?php
if(isset($_GET['error'])){
    if($_GET['error'] == "regsuccess"){
        echo '<script>setTopBarMessage("Registration successful");</script>';        
    } else if ($_GET['error'] == "regfailed") {
        echo '<script>setTopBarMessage("Registration failed");</script>';
    } else if ($_GET['error'] == "upd_success") {
        echo '<script>setTopBarMessage("Profile updated");</script>';
    } else if ($_GET['error'] == "upd_failed") {
        echo '<script>setTopBarMessage("Profile update failed");</script>';
    }
}
?>