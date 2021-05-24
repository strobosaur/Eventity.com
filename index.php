<?php
    include_once './include/views/_header.php';
?>

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
    <?php
        include 'event_list.php';
    ?>
</div>

<?php
    /*include_once 'login_errors.php';
    include_once 'register_errors.php';*/
    include_once './include/views/_footer.php';
?>