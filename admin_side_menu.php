<?php
session_start();

// SECURITY
if (!isset($_POST['admin_side_menu']) || ($_SESSION['account_type'] < 1)) {
    header("location: index.php");
    exit();
} else {

    // CREATE ADMIN SIDE MENU
    $sideMenu =
    '<div class="container" id="menu-container">
        <div class="header" id="menu-header">
            <h2>Admin menu</h2>
        </div>

        <button type="submit" name="auth-events-btn" id="auth-events-btn">Event list</button>
        <button type="submit" name="user-list-btn" id="auth-events-btn">User list</button>
        
    </div>';
    echo $sideMenu;
}
?>