<?php
session_start();

// SECURITY
if(!isset($_POST['get_search_menu']) || !isset($_SESSION['userID'])){
    header("location: index.php");
    exit();
} else {
    
    // GET SITE MESSAGE
    $returnMsg = '';
    if($file = fopen('./admin/message.txt', "r")){
        while(!feof($file)){
            $returnMsg .= fgets($file);
        }
        fclose($file);
    }

    // MAKE SIDE MENU HTML
    $sideMenu =
    '<div class="container" id="menu-container">

        <div class="header" id="menu-header">
            <h2>Search</h2>
        </div> 

        <form class="form" id="form-search" name="form-search" onsubmit="" action="search_process.php" method="POST">
                                
            <div class="form-control">
            <label>Search string</label>
            <input type="text" placeholder="words..." name="search_text" id="search_text" autocomplete="off">
            <small>Error message</small>
            </div>
            
            <button type="submit" name="search" id="search">Search</button>
                                
        </form>
    </div>';

    $sideMenu .=
    '<div class="container" id="news-container">

        <div class="header" id="news-header">
            <h2>Site news</h2>
        </div>
        
        <div class="news-box" id="news-box">'
            . $returnMsg .
        '</div>

    </div>';

    echo $sideMenu;
}
?>