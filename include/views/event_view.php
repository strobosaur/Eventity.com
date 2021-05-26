<?php
session_start();

if(!isset($_SESSION['userID']) || !isset($_POST['submit'])){
    header("location: index.php");
    exit();
} else {
    ?>
    <container class="container "id="event-view">
        <div class="event-view-box" id="event-view-box" name="event-view-box">
            <div class="event-view-header" id="event-view-header">

            </div>
        </div>
    </container>
    <?php
}
?>