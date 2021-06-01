<?php
session_start();

if(!isset($_POST['promote-user'])){
    header("location: index.php");
    exit();
} else {

    $userID = $_POST['userID'];
    $newType = $_POST['account_type'];

    $db = new SQLite3("./db/db.db");
    $sql = "UPDATE users
            SET account_type = :account_type
            WHERE userID = :userID";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(":userID", $userID, SQLITE3_INTEGER);
    $stmt->bindValue(":account_type", $newType, SQLITE3_INTEGER);

    if($stmt->execute()){
        echo "true";
    } else {
        echo "false";
    }
}
?>