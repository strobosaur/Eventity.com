<?php
session_start();

// PROTECTION
if(!isset($_POST['get_profile']) || !isset($_SESSION['userID'])) {
    header("location: index.php");
    exit();
} else {

    require_once './include/login.inc.php';
    require_once './include/events.inc.php';

    $profileImg = fetchProfileImg($_SESSION['userID']);
    $userData = userExists($_SESSION['userID']);

    $uname = $userData['uname'];
    $fname = $userData['fname'];
    $lname = $userData['lname'];
    $email = $userData['email'];
    
    // CREATE LOGIN FORM
    $profileLeft =
    '<div class="container">
        <div id="profile-left">
            <div class="header">
                <h2>Profile</h2>    
            </div>

            <div class="profile-view-top" id="profile-view-top">
                <img id="profile-img" src="' . $profileImg . '" width="96px" height="96px">
                <h3 id="profile-h3">' . $uname . '</h3>    
            </div>                        

            <div class="profile-view-main">
                <div class="left-column">
                    <p2>First name: </p2>
                    <p2>Last name: </p2>
                    <p2>Email: </p2>
                </div>
                <div class="right-column">
                    <p1>' . $fname . '</p1><br>
                    <p1>' . $lname . '</p1><br>
                    <p1>' . $email . '</p1>
                </div>
            </div>
            
            <div class="header">
                <h4>Change profile image</h4>    
            </div>
            
            <form class="form" id="form-submit-img" name="form-submit-img" action="register_img_process.php" method="POST" enctype="multipart/form-data">

                <div class="form-control" id="file-upload">
                <input class="custom-file-upload" type="file" name="file" id="file">
                <small>Error message</small>
                </div>

                <button type="submit" name="submit-img" id="submit-img">Upload</button>

            </form>
            
            <form class="form" id="delete-profile-img" action="register_img_delete.php" method="POST" enctype="multipart/form-data">

                <button type="submit" name="delete-img" id="delete-img">Delete profile image</button>

            </form>
        </div>
    </div>';
    
    // CREATE LOGIN FORM
    $profileRight =
    '<div class="container">
        <div id="profile-right">

            <div class="header">
                <h4>Change account info</h4>    
            </div>

            <form class="form" id="form" onsubmit="checkRegInput();" action="register_update.php" method="POST">
                
                <div class="form-control">
                <label>First name</label>
                <input type="text" placeholder="John..." name="fname" id="fname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Last name</label>
                <input type="text" placeholder="Doe..." name="lname" id="lname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Användarnamn</label>
                <input type="text" placeholder="user name..." name="nname" id="nname">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>E-post</label>
                <input type="email" placeholder="user@mail.com..." name="email" id="email">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>Current password</label>
                <input type="password" placeholder="password..." name="password0" id="password0">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>New password</label>
                <input type="password" placeholder="password..." name="password1" id="password1">
                <small>Error message</small>
                </div>
                
                <div class="form-control">
                <label>New password confirmation</label>
                <input type="password" placeholder="password..." name="password2" id="password2">
                <small>Error message</small>
                </div>
                
                <button type="submit" name="update" id="update">Update</button>
                                
            </form>
        </div>
    </div>';

    // CREATE RETURN ARRAY
    $returnArr = array("left"=>$profileLeft,"right"=>$profileRight);
    echo json_encode($returnArr);
}
?>