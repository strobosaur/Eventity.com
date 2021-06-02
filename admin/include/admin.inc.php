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
    $evtAdress = $row['event_adress'];

    if(($evtPrice <= 0) || ($evtPrice == null)){
        $evtPrice = "FREE!";
    }

    if($evtAdress != null){
        $evtAdress = "Location: " . $evtAdress;
    }

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
                <small>' . $evtAdress . '<br>
                Price: ' . $evtPrice . '</small>
            </div>
        </div>
        </div>
        <div class="event-box-admin2" id="event-box">';

        if($row['adminOK'] != 1){
            $event .=
            '<button class="event-admin-ok-btn" type="submit" id="link-btn-small" data-cid="'. $evtID .'"><img id="img-approve" src="./img/check3.png" width="32px" height="32px"></button>';
        }

        $event .=
            '<button class="event-admin-deny-btn" type="submit" id="link-btn-small" data-cid="'. $evtID .'"><img id="img-deny" src="./img/cross3.png" width="32px" height="32px"></button>
        </div>
    </container>';

    // POST ITEM
    echo $event;
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

    $userAccType = $row['account_type'];
    $userAccount = "Standard";

    // COMPACT DATE FORMAT
    $regDate = getDateFromDateTime($userDate);
    $regTime = getTimeFromDateTime($userDate);
    $regDateTime = $regDate . ", " . $regTime;

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
                        
            </div>

            <div class="user-box-mid">
                <div class="user-box-midtop">
                    <img id="profile-img2" src="' . $profileImg . '" width="48px" height="48px">
                    <button class="view-user-btn" type="submit" data-cid="' . $userID . '" name="view-user-btn" id="view-user-btn">' . $userUname . '</button>
                </div>

                <div class="user-box-midbot">
                    <div class="user-box-midbot-left">

                        <div class="left-box">
                            <p2>Email:</p2>
                            <p2>Reg date:</p2>
                            <p2>Account:</p2>
                        </div>
                        <div class="right-box">
                            <p1>' . $userEmail . '</p1>
                            <p1>' . $regDateTime . '</p1>
                            <p1>' . $userAccount . '</p1>
                        </div>

                    </div>
                    <div class="user-box-midbot-mid">

                        <div class="left-box">
                            <p2>Fname:</p2>
                            <p2>Lname:</p2>
                            <p2>Bdate:</p2>
                        </div>
                        <div class="right-box">
                            <p1>' . $userFname . '</p1>
                            <p1>' . $userLname . '</p1>
                            <p1>'. $userBirthDate . '</p1>
                        </div>
                        
                    </div>
                    <div class="user-box-midbot-right">

                        <div class="left-box">
                            <p2>Adress:</p2>
                            <p2> </p2>
                            <p2>Age:</p2>
                        </div>
                        <div class="right-box">
                            <p1>' . "" . '</p1>
                            <p1>' . "" . '</p1>
                            <p1>'. $userAge . '</p1>
                        </div>

                    </div>
                </div>                

                <div class="user-box-midbot2">';

                // MAKE ADMIN BUTTON
                if($userAccType != 2){
                    $userBox .=
                    '<button class="user-admin-btn" type="submit" id="link-btn-small" data-cid="'. $userID .'">Make admin</button>';
                }

                // MAKE MODERATOR BUTTON
                if($userAccType != 1){
                    $userBox .=
                    '<button class="user-moderator-btn" type="submit" id="link-btn-small" data-cid="'. $userID .'">Make moderator</button>';
                }

                // MAKE PLEB BUTTON
                if($userAccType != 0){
                    $userBox .=
                    '<button class="user-standard-btn" type="submit" id="link-btn-small" data-cid="'. $userID .'">Make standard</button>';
                }

                // DELETE ACCOUNT BUTTON
                $userBox .=
                    '<button class="user-delete-btn" type="submit" id="link-btn-small" data-cid="'. $userID .'">Delete account</button>
                </div>
            </div>

            <div class="user-box-right" id="user-box">
            </div>
        </div>
    </container>';

    // POST ITEM
    echo $userBox;
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

// FUNCTION 

?>