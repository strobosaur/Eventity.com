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

// FUNCTION FETCH PROFILE IMG
function fetchProfileImg($userID) {
    $result = userExists($userID);
    if ($result !== false) {
        if ($result['profileImg'] != null) {
            return $result['profileImg'];
        } else {
            return false;
        }
    } else {
        return false;
    }
}
    
// FUNCTION LOGIN USER TO SITE
function loginUser($userID, $password){

    // USER IN DATABASE?
    $userData = userExists($userID);

    if ($userData === false) {
        header("location: ./index.php?error=nouser");
        exit();
    }

    // CHECK PASSWORD MATCH
    if (passwordMatchesDB($userID, $password) === false) {
        header("location: ./index.php?error=wrongpwd");
        exit();
    } else {

        // START SESSION & SESSION VARIABLES
        session_start();

        $_SESSION["userID"] = $userData['userID'];
        $_SESSION["user_fname"] = $userData['fname'];
        $_SESSION["user_lname"] = $userData['lname'];
        $_SESSION["user_uname"] = $userData['uname'];
        $_SESSION["user_email"] = $userData['email'];
        $_SESSION["user_profileimg"] = $userData['profile_img'];
        $_SESSION["logged_in"] = true;

        header("location: ./index.php?error=loggedin");
        exit();
    }    
}

// FUNCTION REGISTER USER TO DB
function registerUser($fname,$lname,$uname,$email,$pwd1,$pwd2){

    // TRIM INPUT VARIABLES
    $fnameValue = trim($fname);
    $lnameValue = trim($lname);
    $unameValue = trim($uname);
    $emailValue = trim($email);
    //$pnrValue = isPnr(trim($pnr));

    // INPUT VALIDATION
    if(($pwd1 !== $pwd2)
    || (strlen($fnameValue) < 2)
    || (strlen($lnameValue) < 2)
    || (strlen($unameValue) < 4)
    || (!isEmail($emailValue))
    //|| ($pnrValue === false)
    || (userExists($unameValue) !== false)
    || (userExists($emailValue) !== false)
    /*|| (userExists($pnrValue) !== false)*/) {

        return false;

    } else {

        // HASH PASSWORD
        $pwdHashed = password_hash($pwd1, PASSWORD_DEFAULT);

        // PREPARE DB QUERY
        $db = new SQLite3("./db/db.db");

        $sql = "INSERT INTO 'users' (fname, lname, uname, email, pwd_hashed)
                VALUES (:fname, :lname, :uname, :email, :pwd)";

        $stmt = $db->prepare($sql);

        $stmt->bindParam('fname', $fnameValue, SQLITE3_TEXT);
        $stmt->bindParam('lname', $lnameValue, SQLITE3_TEXT);
        $stmt->bindParam('uname', $unameValue, SQLITE3_TEXT);
        $stmt->bindParam('email', $emailValue, SQLITE3_TEXT);
        //$stmt->bindParam('pnr', $pnrValue, SQLITE3_TEXT);
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

// FUNCTION UPDATE USER BASE PROFILE
function updateUserProfile($userID,$userFname,$userLname,$userUname,$userEmail,$password1,$password2) {

    if ($password1 !== $password2) {
        header("location: profile.php?error=pwdmissmatch");
        exit();
    }

    // TRIM VARIABLES
    $userFnameValue = trim($userFname);
    $userLnameValue = trim($userLname);
    $userUnameValue = trim($userUname);
    $userEmailValue = trim($userEmail);

    // INPUT VALIDATION
    if (strlen($userFnameValue) < 2) {        
        header("location: profile.php?error=fnameshort");
        exit();
    } else if (strlen($userLnameValue) < 2) {        
        header("location: profile.php?error=lnameshort");
        exit();
    } else if (strlen($userUnameValue) < 2) {        
        header("location: profile.php?error=nnameshort");
        exit();
    } else if (strlen($password1) < 8) {        
        header("location: profile.php?error=pwdshort");
        exit();
    } else if (!isEmail($userEmailValue)) {
        header("location: profile.php?error=invalidemail");
        exit(); 
    }
    
    // CHECK FOR EMAIL TAKEN
    $result = userExists($userEmailValue);
    if ($result !== false) {
        if ($result['userID'] != $userID) {
            header("location: profile.php?error=emailtaken");
            exit();
        } 
    }
    
    // CHECK FOR USER NAME TAKEN
    $result = userExists($userUnameValue);
    if ($result !== false) {
        if ($result['userID'] != $userID) {
            header("location: profile.php?error=nnametaken");
            exit();
        } 
    }

    // HASH PASSWORD
    $hashedPwd = password_hash($password1, PASSWORD_DEFAULT);

    // PREPARE QUERY
    $db = new SQLite3("./db/labb1.db");

    $sql = "UPDATE 'users' 
            SET fname = :fname, lname = :lname, uname = :uname, email = :email, pwd_hashed = :pwd_hashed
            WHERE userID = :userID";

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':fname', $userFnameValue, SQLITE3_TEXT);
    $stmt->bindParam(':lname', $userLnameValue, SQLITE3_TEXT);
    $stmt->bindParam(':uname', $userUnameValue, SQLITE3_TEXT);
    $stmt->bindParam(':email', $userEmailValue, SQLITE3_TEXT);
    $stmt->bindParam(':pwd_hashed', $hashedPwd, SQLITE3_TEXT);
    $stmt->bindParam(':userID', $userID, SQLITE3_INTEGER);

    // EXECUTE STATEMENT
    if ($stmt->execute()){

        // UPDATE SESSION
        $_SESSION["user_fname"] = $userFnameValue;
        $_SESSION["user_lname"] = $userLnameValue;
        $_SESSION["user_uname"] = $userUnameValue;
        $_SESSION["user_email"] = $userEmailValue;

        $db->close();
        return true;

    } else {
        $db->close();
        return false;
    }    
}

// FUNCTION REGISTER USER ADRESS
function registerUserAdress($userID,$street,$zip,$city) {

    // FIND USER
    $result = userExists($userID);

    // CHECK IF USER EXISTS
    if($result !== false){

        // PREPARE DB QUERY
        $db = new SQLite3("./db/db.db");

        $sql = "UPDATE 'users'
                SET street = :street, zip = :zip, city = :city
                WHERE userID = :userID";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':street', $street, SQLITE3_TEXT);
        $stmt->bindParam(':zip', $zip, SQLITE3_TEXT);
        $stmt->bindParam(':city', $city, SQLITE3_TEXT);

        // EXECUTE DB QUERY
        if($stmt->execute()){
            $db->close();
            return true;
        } else {
            $db->close();
            return false;
        }
    }
}

// FUNCTION UPLOAD PROFILE IMAGE
function uploadProfileImg($userID,$fileName,$fileTmpName,$fileError) {

    // CHECK IF USER EXISTS
    $result = userExists($userID);


    $fileExt = end(explode('.', strtolower($fileName)));

    // ALLOWED FILETYPES
    $allowedExtArr = array('jpg', 'jpeg', 'png');

    if (in_array($fileExt, $allowedExtArr)) {
        if (($fileError === 0) && ($result !== false)) {

            // CREATE FILE NAME AND MOVE TO FOLDER
            $fileNameNew = date("Ymd") . "_profile_" . $result['userID'] . "_" . mt_rand() . "." . $fileExt;
            $fileDestination = "./uploads/profile/" . $fileNameNew;
            move_uploaded_file($fileTmpName,$fileDestination);

            // RETURN NEW FILE PATH
            return $fileDestination;

        } else {
            return false;
        }
    } else {
        return false;
    }
}

// FUNCTION CHANGE USER PROFILE IMAGE
function changeProfileImg($userID, $filePath) {

    // CHECK IF USER EXISTS
    $result = userExists($userID);

    // DELETE OLD IMAGE IF EXISTS
    if ($result != false) {
        $oldProfileImg = $result['profileImg'];

        if ($oldProfileImg != null) {
            unlink($oldProfileImg);
        }

        // PREPARE DB QUERY
        $db = new SQLite3("./db/labb1.db");

        $sql1 = "UPDATE 'users'
                SET profile_img = :profile_img
                WHERE email = :email";

        $stmt1 = $db->prepare($sql1);

        $stmt1->bindParam(':email', $userID, SQLITE3_TEXT);
        $stmt1->bindParam(':profile_img', $filePath, SQLITE3_TEXT);

        // EXECUTE STATEMENT
        if ($stmt1->execute()) {
            $db->close();
            return true;
        } else {
            $db->close();
            return false;
        }
    }
}

?>
