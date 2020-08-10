<?php
    header('content-type: application/json');
    include 'init.php';
    $user = $_POST['User'];
    $pwd = $_POST['Pwd'];
    $email = $_POST['Email'];
    $surname = $_POST['Surname'];
    $phone = $_POST['Phone'];
    $addr = $_POST['Addr'];
    $time = date("Y/m/d H:i:s");
    $sql = "Select * from member where user = '$user'";
    $obj_query = mysqli_query($conn,$sql);
    // 檢查是否重複
    if(empty(mysqli_fetch_array($obj_query))){
        $insert_member = "Insert into member(`user`,pwd,email,surname,phone,bouns,addr,date) 
                        values('$user','$pwd','$email','$surname','$phone','0','$addr','$time')";
        mysqli_query($conn,$insert_member);
        header("Location: https://fbbot.youcanbemama.com/tworder/signup.php"); 
        exit;
    }
    else{
        header("Location: https://fbbot.youcanbemama.com/tworder/login.php"); 
        exit;
    }

?>