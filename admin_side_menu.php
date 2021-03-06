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

        <button type="submit" name="auth-events-btn" id="auth-events-btn">Events awaiting approval</button>
        <button type="submit" name="all-events-btn" id="all-events-btn">All events list</button>
        <button type="submit" name="user-list-btn" id="user-list-btn">User list</button>
        <button type="submit" name="update-news-btn" id="update-news-btn">Update site news</button>
        
    </div>';
    echo $sideMenu;
}
?>