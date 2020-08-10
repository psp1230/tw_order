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
    $insert_record = "Insert into record(user,money,`desc`,surname,date) values('$user','$money','$desc','$name','$date')";
    if(mysqli_query($conn,$insert_record)){
        echo 'true';
    }
?>