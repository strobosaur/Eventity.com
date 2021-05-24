<?php
$sideMenu =
'<div class="container" id="menu-container">
    <div class="header" id="menu-header">
        <h2>Menu</h2>
    </div>

    <form class="form" id="side-menu-form" action="event_create.php" method="POST">

    <button type="submit" name="create-event-btn" id="create-event-btn">Create new event</button>

    </form>
    
    <div class="success-message" id="success-message">
        <h4 id="message"></h4>
    </div>
</div>';
echo $sideMenu;
?>