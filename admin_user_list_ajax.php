<?php
    session_start();

// SECURITY
if((!isset($_POST['admin_user_list'])) || (!$_SESSION['account_type'] >= 1)){
    header("location: index.php");
    exit();
} else {
    require_once './admin/include/admin.inc.php';
    require_once './include/events.inc.php';
    require_once './include/login.inc.php';

    // GET ALL USERS QUERY
    $db = new SQLite3("./db/db.db");

    $sql = "SELECT * FROM users
            ORDER BY userID DESC";
    $result = $db->query($sql);

    // MAKE ITEM FOR EVERY USER
    $userList = '';
    while($row = $result->fetchArray()){
        $userList .= makeAdminUserListItem($row);
    }

    // RETURN USER LIST
    echo $userList;
}
?>