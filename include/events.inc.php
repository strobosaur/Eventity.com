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

// FUNCTION ADD IMAGE TO EVENT
function addImgToEvent($eventID, $imgPath){
    $result = eventExists($eventID);

    if($result !== false) {
        $db = new SQLite3("./db/db.db");
        $sql = "INSERT INTO event_img (eventID, img_path) VALUES ($eventID, $imgPath)";
        if($db->query($sql)){
            $db->close();
            return true;
        } else {
            $db->close();
            return false;
        }
    }
}

//FUNCTION REMOVE IMAGE FROM EVENT
function removeImageFromEvent($eventID, $imgPath) {
    $db = new SQLite3("./db/db.db");
    $sql = "DELETE FROM event_img WHERE eventID = $eventID, img_path = $imgPath";
    if($db->query($sql)){
        $db->close();
        return true;
    } else {
        $db->close();
        return false;
    }
}

// FUNCTION DELETE POST
function deleteEvent($eventID) 
{
    $resultEvent = eventExists($eventID);
    
    if ($resultEvent === false) {
        return false;
    } else {
        // DELETE IMAGE(S)
        $db = new SQLite3("./db/db.db");

        $sql = "SELECT * FROM event_img WHERE eventID = :eventID";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':eventID', $eventID, SQLITE3_INTEGER);
        $resultImg = $stmt->execute();

        // DELETE IMAGE FILES
        while ($row = $resultImg->fetchArray()){
            unlink($row['img_path']);
        }

        //PREPARE DB QUERY IMAGE DELETE
        $sql = "DELETE * FROM event_img WHERE eventID = :eventID";
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':eventID', $eventID, SQLITE3_INTEGER);

        $stmt->execute();

        // PREPARE DB QUERY EVENT DELETE
        $sql = "DELETE FROM 'events' WHERE eventID = :eventID";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':eventID', $eventID, SQLITE3_INTEGER);

        // EXECUTE QUERY
        if ($stmt->execute()) {
            $db->close();
            exit();
        } else {
            $db->close();
            exit();
        }
    }
}

//FUNCTION ADD ATTENDEE TO EVENT
function addAttendee($eventID, $userID) {
    $db = new SQLite3("./db/db.db");
    $sql = "INSERT INTO attending (eventID, userID) VALUES ($eventID, $userID)";
    if($db->query($sql)){
        $db->close();
        return true;
    } else {
        $db->close();
        return false;
    }
}

//FUNCTION REMOVE ATTENDEE FROM EVENT
function removeAttendee($eventID, $userID) {
    $db = new SQLite3("./db/db.db");
    $sql = "DELETE FROM attending WHERE eventID = $eventID, userID = $userID";
    if($db->query($sql)){
        $db->close();
        return true;
    } else {
        $db->close();
        return false;
    }
}

?>