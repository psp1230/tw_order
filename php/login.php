<?php
    header('content-type: application/json');
    include 'init.php';
    $acc = $_POST['User'];
    $pwd = $_POST['Pwd'];
    $sql = "Select * from member where user = '$acc' && pwd = '$pwd'";
    $obj = mysqli_query($conn, $sql);
    if(mysqli_fetch_array($obj)){
        echo 'true';
    }
    else{
        echo 'false';
    }
    mysqli_close($conn);
?>