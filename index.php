<?php
    include_once './include/views/_header.php';
?>

<div id="mid-column">

    <div class="left-field" id="left-field">
        <?php
            if(!isset($_SESSION['userID'])){
                echo "<script>getLoginAjax();</script>";
            } else {            
                echo "<script>getSideMenuAjax();</script>";
            }
        ?>
    </div>

    <div class="event-list" id="event-list">
    </div>

    <div id="logo-field">
        <img src="./img/eventity_logo.png">
    </div>

</div>

<?php
    include_once 'message_handling.php';
?>

<script>
    $(document).ready(function(){
        updateEventListAjax();
    });
    var eventListUpdate = setInterval(updateEventListAjax, 5000);
</script>

<?php
    include_once './include/views/_footer.php';
?>