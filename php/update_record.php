<?php
    include 'init.php';
    if(empty($_POST['user'])){
        exit();
    }
    if(empty($_POST['money'])){
        exit();
    }
    if(empty($_POST['date'])){
        exit();
    }
    $id = $_POST['id'];
    $user = $_POST['user'];
    $desc = $_POST['desc'];
    $money = $_POST['money'];
    $date = $_POST['date'];
    $select_userid = "Select * from member where user = '$user'";
    $obj = mysqli_query($conn,$select_userid);
    $row = mysqli_fetch_array($obj);
    $name = $row['surname'];
    if(empty($name)){
        echo 'false';
        exit();
    }
    $update_record = "Update record set user = '$user', money = '$money', date = '$date',surname = '$name',  `desc` = '$desc' where id = '$id'";
    if(mysqli_query($conn,$update_record)){
        echo 'true';
    }
    else{
        echo 'false';
    }
    
?>