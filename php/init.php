<?php
    date_default_timezone_set("Asia/Taipei");
    // $servername = "infinitywp.com";
    // $username = "uzgg56y2dg8a2";
    // $password = "h23121231";
    // $dbname = "dbybwuvh235jmw";

    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "tworder";
    $conn = mysqli_connect($servername, $username, $password,$dbname) or die('Error with MySQL connection');
?>