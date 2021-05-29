<?php
if(isset($_GET['error'])){
    if($_GET['error'] == "regsuccess"){
        echo '<script>setTopBarMessage("Registration successful");</script>';        
    } else if ($_GET['error'] == "regfailed") {
        echo '<script>setTopBarMessage("Registration failed");</script>';
    }
}
?>