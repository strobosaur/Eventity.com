<!DOCTYPE html>

<?php
    session_start();
?>

<html>

<head>
    <title>carpe.diem.nu</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./css/styles.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
    integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
    crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
    integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
    crossorigin=""></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="./js/scripts.js"></script>
    <script src="./admin/js/functions.js"></script>
    <script src="./js/get_map.js"></script>
    <script src="./js/weather.js"></script>
</head>

<body>
    <nav id="nav-menu" name="nav-menu">
        <script>getMenuAjax();</script>
    </nav>
    <div id="background-box">

    </div>

    <div class="message-bar" id="message-bar">
    </div>