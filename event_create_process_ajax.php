<?php
    session_start();
    
    if(!isset($_POST["create"]) || !isset($_SESSION["userID"])) {
        header("location: index.php");
        exit();
    } else {

        require_once './include/login.inc.php';

        // GET REGISTRATION INPUT
        $evtName = $_POST['evt_name'];
        $evtUserID = $_SESSION['userID'];
        $evtText = $_POST['evt_text'];

        if($_POST['evt_indoors'] == "1"){
            $evtIndoors = "1";
        } else {
            $evtIndoors = "0";
        }

        $evtStartDate = $_POST['evt_sdate'];
        $evtStartTime = $_POST['evt_stime'];

        $evtAdress = $_POST['evt_adress'];
        
        $evtLat = $_POST['evt_lat'];
        $evtLng = $_POST['evt_lng'];

        $evtPrice = $_POST['evt_price'];

        // PREPARE QUERY
        $db = new SQLite3("./db/db.db");

        $sql = "INSERT INTO events (event_userID, event_name, event_text, event_indoors, event_adress, event_lat, event_lng, event_date, event_time, event_price, adminOK)
                VALUES (:event_userID, :event_name, :event_text, :event_indoors, :event_adress, :event_lat, :event_lng, :event_date, :event_time, :event_price, :adminOK)";

        $stmt = $db->prepare($sql);

        // BIND PARAMETERS
        $stmt->bindValue(":event_userID", $evtUserID, SQLITE3_INTEGER);
        $stmt->bindParam(":event_name", $evtName, SQLITE3_TEXT);
        $stmt->bindParam(":event_text", $evtText, SQLITE3_TEXT);

        $stmt->bindValue(":event_indoors", $evtIndoors, SQLITE3_INTEGER);

        $stmt->bindParam(":event_adress", $evtAdress, SQLITE3_TEXT);
        
        $stmt->bindParam(":event_lat", $evtLat, SQLITE3_TEXT);
        $stmt->bindParam(":event_lng", $evtLng, SQLITE3_TEXT);

        $stmt->bindParam(":event_date", $evtStartDate, SQLITE3_TEXT);
        $stmt->bindParam(":event_time", $evtStartTime, SQLITE3_TEXT);

        $stmt->bindValue(":event_price", $evtPrice, SQLITE3_INTEGER);

        $stmt->bindValue(":adminOK", 0, SQLITE3_INTEGER);

        // REGISTER USER
        if($stmt->execute()) {
            echo "true";
        } else {
            echo "false";
        }
    }
?>