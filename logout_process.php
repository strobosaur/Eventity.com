<?php
    session_start();
    session_unset();
    session_destroy();
    header("location: index.php");
    ?>
    <script>
        $("#profile-img-menu-field").empty();
    </script>
    <?php
?>