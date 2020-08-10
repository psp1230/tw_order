<?php
    include './php/init.php';
    $user = $_POST['user'];
    $color = $_POST['color'];
    $size = $_POST['size'];
    $qat = $_POST['qat'];
    $price = $_POST['price'];
    $sum = $qat * $price;
    $status = $_POST['status'];
    $date = $_POST['date'];
    $desc = $_POST['desc'];
    $image = '';
    if(empty($user)){
        echo 'false';
        exit();
    }
    if(empty($color)){
        echo 'false';
        exit();
    }
    if(empty($size)){
        echo 'false';
        exit();
    }
    if(empty($qat)){
        echo 'false';
        exit();
    }
    if(empty($price)){
        echo 'false';
        exit();
    }
    if(empty($status)){
        echo 'false';
        exit();
    }
    if(empty($date)){
        echo 'false';
        exit();
    }
    $select_userid = "Select * from member where user = '$user'";
    $obj = mysqli_query($conn,$select_userid);
    $row = mysqli_fetch_array($obj);
    $userid = $row['id'];
    if(empty($userid)){
        echo 'false';
        exit();
    }
    else{
        $NowTime = date("Y/m/d H:i:s");
        $tmp_time = strtotime($NowTime);
        $imgname = $_FILES['file']['name'];
        $imgtype = $_FILES['file']['type'];
        $file = $_FILES['file']['tmp_name'];
        $exten = substr(strrchr($_FILES['file']['name'], "."), 1);
        $dest = './assets/images/' . $tmp_time . '.' . $exten;
        if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($file, $dest)) {
                $insert_order = "Insert into 
                                        `order`(userid, color, size, qat, price, sum, `status`, imgname, imgtype, imgpic, original_name,date,`desc`)
                                        values('$userid','$color','$size','$qat','$price','$sum','$status','" . $tmp_time . '.' . $exten . "','$imgtype','$dest','$imgname','$date','$desc')";
                mysqli_query($conn, $insert_order);
                echo 'true';
            }
        }
        else{
            echo 'false';
            exit();
        }
    }
?>