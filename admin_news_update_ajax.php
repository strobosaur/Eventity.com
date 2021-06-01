<?php
session_start();

// SECURITY
if(!isset($_POST['update-msg']) || !isset($_SESSION['userID'])){
    header("location: index.php");
    exit();
} else {

// CREATE EVENT BOX
$newsUpdateBox =
'<div class="container" id="create-event">
    <div id="event-view-box">

        <div class="header">
            <h2>Update news box</h2>
        </div>

        <form class="form-event" id="news-msg-form" name="news-msg-form" method="POST" onsubmit="" action="admin_news_process_ajax.php">

            <div class="form-control">
            <label>New message</label>
            <textarea placeholder="news..." name="new_msg" id="new_msg" maxlength="1000" required></textarea>
            <span></span>
            <small>Error message</small>
            </div>            
        
            <button type="submit" name="post-new-msg" id="post-new-msg">Update message</button>

        </form>
    </div>
</div>';

echo $newsUpdateBox;

}

?>