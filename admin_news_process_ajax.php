<?php
session_start();

// SECURITY
if(!isset($_POST['new_msg'])){
    header("location: index.php");
    exit();
} else {

    $msg = '<p>' . $_POST['new_msg'] . '</p>';
    
    // GET SITE MESSAGE
    $fp = fopen('./admin/message.txt', 'w+');
    if($fp){
        fwrite($fp, $msg);
        fclose($fp);
        echo $msg;
    } else {
        echo "false";
    }
}

?>