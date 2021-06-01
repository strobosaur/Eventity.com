<?php
// MAKE ADMIN EVENT LIST ITEM
function makeAdminListItem($row){

    $creator = userExists($row['event_userID']);
    $profileImg = fetchProfileImg($creator['email']);

    $evtID = $row['eventID'];
    $evtUname = $creator['uname'];

    $evtName = $row['event_name'];
    $evtTime = $row['event_time'];
    $evtPrice = $row['event_price'];
    $evtDate = $row['event_date'];
    $evtCity = $row['event_city'];

    // CREATE EVENT ITEM
    $event =
    '<container class="container">
        <div class="event-box-admin" id="event-box">
        <button class="view-event-btn" type="submit" data-cid="' . $evtID . '" name="view-event-btn" id="view-event-btn">' . $evtName . '</button>';

        $event .=
        '<div class="event-list-low">
            <div class="event-list-lowleft">
                <img id="profile-img2" src="' . $profileImg . '" width="40px" height="40px">
                <small>Created by: <br>' . $evtUname . '</small>
            </div>
            <div class="event-list-lowmid">
                <small>Date: ' . $evtDate . '<br>
                    Time: ' . $evtTime . '</small>
            </div>
            <div class="event-list-lowright">
                <small>' . $evtCity . '<br>
                Price: ' . $evtPrice . '</small>
            </div>
        </div>
        </div>
        <div class="event-box-admin2" id="event-box">
            <button class="event-admin-ok-btn" type="submit" id="link-btn-small" data-cid="'. $evtID .'"><img id="img-approve" src="./img/check3.png" width="32px" height="32px"></button>
            <button class="event-admin-deny-btn" type="submit" id="link-btn-small" data-cid="'. $evtID .'"><img id="img-deny" src="./img/cross3.png" width="32px" height="32px"></button>
        </div>
    </container>';

    // POST ITEM
    echo $event;
}

// FUNCTION APPROVE EVENT
function approveEvent($eventID){
    $db = new SQLite3("./db/db.db");
    $sql = "UPDATE 'events'
            SET adminOK = :adminOK
            WHERE eventID = :eventID";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(":eventID", $eventID, SQLITE3_INTEGER);
    $stmt->bindValue(":adminOK", 1, SQLITE3_INTEGER);
    if($stmt->execute()){
        $db->close();
        return true;
    } else {
        $db->close();
        return false;
    }
}

// MAKE ADMIN EVENT LIST ITEM
function makeAdminUserListItem($row){

    $profileImg = fetchProfileImg($row['email']);

    $userID = $row['userID'];
    $userUname = $row['uname'];
    $userEmail = $row['email'];

    $userFname = $row['fname'];
    $userLname = $row['lname'];

    $userBirthDate = $row['birth_date'];
    $userDate = $row['reg_date'];

    $userAdress = $row['adress'];
    $userZip = $row['zip'];
    $userCity = $row['city'];
    $userAccType = $row['account_type'];
    $userAccount = "Standard";

    // DETERMINE ACCOUNT TYPE
    if($userAccType == 2){
        $userAccount = "Admin";
    } else if ($userAccType == 1) {
        $userAccount = "Moderator";
    }

    // DETERMINE AGE
    if ($userBirthDate != null){
        $userAge = getUserAge($userID);
    } else {
        $userAge = "";
    }

    // CREATE EVENT ITEM
    $userBox =
    '<container class="container">

        <div class="user-box-admin" id="user-box">

            <div class="user-box-left">
                <img id="profile-img2" src="' . $profileImg . '" width="40px" height="40px">        
            </div>

            <div class="user-box-mid">
                <div class="user-box-midtop>
                    <button class="view-user-btn" type="submit" data-cid="' . $userID . '" name="view-user-btn" id="view-user-btn">' . $userUname . '</button>
                </div>

                <div class="user-box-midbot">
                    <div class="user-box-midbot-left">
                        <p2>Email:</p2><p1>' . $userEmail . '</p1>
                        <p2>Reg date:</p2><p1>' . $userDate . '</p1>
                        <p2>Account:</p2><p1>' . $userAccount . '</p1>
                    </div>
                    <div class="user-box-midbot-mid">
                        <p2>Fname:</p2><p1>' . $userFname . '</p1>
                        <p2>Lname:</p2><p1>' . $userLname . '</p1>
                        <p2>Bdate:</p2><p1>' . $userBirthDate . '</p1>
                    </div>
                    <div class="user-box-midbot-right">
                        <p2>Adress:</p2><p1>' . $userAdress . '</p1>
                        <p2>Zip:</p2><p1>' . $userZip . '</p1>
                        <p2>City:</p2><p1>' . $userCity . '</p1>
                    </div>
                </div>
            </div>

            <div class="user-box-right" id="user-box">
                <button class="user-admin-btn" type="submit" id="link-btn-small" data-cid="'. $userID .'">Make admin<img id="img-approve" src="./img/check3.png" width="32px" height="32px"></button>
                <button class="user-moderator-btn" type="submit" id="link-btn-small" data-cid="'. $userID .'">Make moderator<img id="img-approve" src="./img/check3.png" width="32px" height="32px"></button>
                <button class="user-standard-btn" type="submit" id="link-btn-small" data-cid="'. $userID .'">Make standard<img id="img-approve" src="./img/check3.png" width="32px" height="32px"></button>
                <button class="user-delete-btn" type="submit" id="link-btn-small" data-cid="'. $userID .'">Delete account<img id="img-deny" src="./img/cross3.png" width="32px" height="32px"></button>
            </div>
        </div>
    </container>';

    // POST ITEM
    echo $userBox;
}

?>