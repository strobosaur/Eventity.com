<?php

// CHECK EMAIL INPUT FUNCTION
function isEmail($email) {
    if ((strpos($email, "@") == false) 
    || (strpos($email, ".") == false)
    || (strlen($email) < 6)
    || (strripos($email, ".") < strripos($email,"@"))) {
        return false;
    } else {
        return true;
    }
}

// CHECK PNR INPUT FUNCTION
function isPnr($pnr) {
    $pnrFormat = str_replace('-', '', trim($pnr));

    if ((strlen($pnrFormat) < 10)
    || (strlen($pnrFormat) > 12)
    || (!is_numeric($pnrFormat))) {
        return false;
    } else {
        return $pnrFormat;
    }
}

// FUNCTION PASSWORD MATCHES DB
function passwordMatchesDB($userID, $password) {
    $userData = userExists($userID);

    // USER IN DATABASE?
    if ($userData === false) {
        return false;
    } else {
        // PASSWORD OK?
        $passwordHashed = $userData['passwordHash'];
        $pwdOK = password_verify($password, $passwordHashed);

        if ($pwdOK === false){
            return false;
        } else {
            return true;
        }
    }
}
    
// CHECK IF USER EXISTS IN DATABASE
function userExists($userID){

    // CHECK DATA TYPE
    if (gettype($userID) == "string") {

        // DATA TYPE STRING
        $db = new SQLite3("./db/db.db");        
        $sql = "SELECT * FROM 'users' WHERE uname = :uname OR email = :email OR pnr = :pnr";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':email', $userID, SQLITE3_TEXT);
        $stmt->bindParam(':uname', $userID, SQLITE3_TEXT);
        $stmt->bindParam(':pnr', $userID, SQLITE3_TEXT);

    } else if (gettype($userID) == "integer") {

        // DATA TYPE INTEGER
        $db = new SQLite3("./db/db.db");        
        $sql = "SELECT * FROM 'users' WHERE userID = :userID";

        $stmt = $db->prepare($sql);
        $stmt->bindParam(':userID', $userID, SQLITE3_INTEGER);
    }
    
    // EXECUTE STATEMENT
    $result = $stmt->execute();

    if($row = $result->fetchArray()) {
        $db->close();
        return $row;
    } else {
        $db->close();
        return false;
    }
}

// FUNCTION REGISTER USER TO DB
function registerUser($fname,$lname,$uname,$email,$pnr,$pwd1,$pwd2){

    // TRIM INPUT VARIABLES
    $fnameValue = trim($fname);
    $lnameValue = trim($lname);
    $unameValue = trim($uname);
    $emailValue = trim($email);
    $pnrValue = isPnr(trim($pnr));

    // INPUT VALIDATION
    if(($pwd1 !== $pwd2)
    || (strlen($fnameValue) < 2)
    || (strlen($lnameValue) < 2)
    || (strlen($unameValue) < 4)
    || (!isEmail($emailValue))
    || ($pnrValue === false)
    || (userExists($unameValue) !== false)
    || (userExists($emailValue) !== false)
    || (userExists($pnrValue) !== false)) {

        return false;

    } else {

        // HASH PASSWORD
        $pwdHashed = password_hash($pwd1, PASSWORD_DEFAULT);

        // PREPARE DB QUERY
        $db = new SQLite3("./db/db.db");

        $sql = "INSERT INTO 'users' (fname, lname, uname, email, person_nr, pwd_hashed)
                VALUES (:fname, :lname, :uname, :email, :pnr, :pwd)";

        $stmt = $db->prepare($sql);

        $stmt->bindParam('fname', $fnameValue, SQLITE3_TEXT);
        $stmt->bindParam('lname', $lnameValue, SQLITE3_TEXT);
        $stmt->bindParam('uname', $unameValue, SQLITE3_TEXT);
        $stmt->bindParam('email', $emailValue, SQLITE3_TEXT);
        $stmt->bindParam('pnr', $pnrValue, SQLITE3_TEXT);
        $stmt->bindParam('pwd', $pwdHashed, SQLITE3_TEXT);

        // EXECUTE DB QUERY
        if($stmt->execute()) {
            $db->close();
            return true;
        } else {
            $db->close();
            return false;
        }
    }
}

// FUNCTION REGISTER USER ADRESS
function registerUserAdress($userID,$street,$zip,$city,$cellnr) {
    
}
?>
