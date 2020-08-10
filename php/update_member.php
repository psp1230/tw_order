<?php
    include 'init.php';
    if(empty($_POST['email'])){
        exit();
    }
    if(empty($_POST['phone'])){
        exit();
    }
    if(empty($_POST['addr'])){
        exit();
    }
    $id = $_POST['id'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $addr = $_POST['addr'];
    $update_member = "Update member set email = '$email', phone = '$phone',addr = '$addr' where id = '$id'";
    if(mysqli_query($conn,$update_member)){
        echo 'true';
    }
    else{
        echo 'false';
    }
    
?>