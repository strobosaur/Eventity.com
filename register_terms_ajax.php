<?php

// SECURITY
if(!isset($_POST['get-terms'])){
    header("location: index.php");
    exit();
} else {

    // CREATE TERMS & CONDITIONS BOX
    $termsBox =
    '<div class="container">
        <div id="terms-box">

            <div class="header">
                <h4>Terms & conditions</h4>    
            </div>

            <p>
            <b>User conditions</b><br><br>
            When you create an account with us you accept that you are responsible 
            for all material that you choose to publicize and that it does not make 
            any copyright infringements. Eventity denies all responsibility for any 
            content created by our users. If a user violates our terms and conditions 
            the users account will be deleted, and the person behind the account 
            will be prosecuted to the full extent of the law, if applicable.<br><br>
            
            <b>Treatment of user data</b><br><br>
            
            Eventity processes and stores information about the users username and email. 
            The user may choose to upload a full name and/or birth date if he chooses to 
            do so. All of this information is kept secure in our database, and is 
            permanently deleted if and when the user should choose to delete his account.
            </p>

        </div>
    </div>';

    echo $termsBox;
}

?>