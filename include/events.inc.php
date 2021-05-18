<?php

// FUNCTION GET TIME FROM SQL
function getTimeFromDateTime($dateTime){
    $timeRaw = explode(" ",$dateTime);
    $timeArr = explode(":",$timeRaw[1]);
    return ($timeArr[0] . ":" . $timeArr[1]);
}

// FUNCTION GET DATE FROM SQL
function getDateFromDateTime($dateTime){
    $dateRaw = explode(" ",$dateTime);
    return str_replace("-","/",$dateRaw[0]);
}

// FUNCTION CHECK IF EVENT EXISTS
function eventExists($eventID)
{
    $db = new SQLite3("./db/db.db");
    $sql = "SELECT * FROM events WHERE eventID = :eventID";

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':eventID', $eventID, SQLITE3_INTEGER);
    $result = $stmt->execute();

    if($row = $result->fetchArray()){
        $db->close();
        return $row;
    } else {
        $db->close();
        return false;
    }
}

// FUNCTION UPLOAD IMAGE
function uploadImg($fileName,$fileTmpName,$fileError) {

    // GET FILE EXTENSION OF INPUT FILE
    $fileExt = end(explode('.', strtolower($fileName)));

    // ALLOWED FILE EXTENSIONS
    $allowedExtArr = array('jpg', 'jpeg', 'png');

    // EXTENSION ALLOWED?
    if (in_array($fileExt, $allowedExtArr)) {
        if ($fileError === 0) {

            // CREATE FILE NAME & MOVE TO DESTINATION
            $fileNameNew = date("Ymd_His_") . uniqid('',true) . "." . $fileExt;
            $fileDestination = "./uploads/img/" . $fileNameNew;
            move_uploaded_file($fileTmpName,$fileDestination);

            // RETURN NEW DESTINATION
            return $fileDestination;
        } else {
            return false;
        }
    } else {
        return false;
    }
}
?>