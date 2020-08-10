<?php
    include './php/init.php';
    $id = $_POST['id'];
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
    $select_userid = "Select * from member where user = '$user'";
    $obj = mysqli_query($conn,$select_userid);
    $row = mysqli_fetch_array($obj);
    $userid = $row['id'];
    if(empty($userid)){
        echo 'false';
        exit();
    }
    if(!empty($_FILES)){
        $NowTime = date("Y/m/d H:i:s");
        $tmp_time = strtotime($NowTime);
        $imgname = $_FILES['file']['name'];
        $imgtype = $_FILES['file']['type'];
        $file = $_FILES['file']['tmp_name'];
        $exten = substr(strrchr($_FILES['file']['name'], "."), 1);
        $dest = './assets/images/' . $tmp_time . '.' . $exten;
        if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
            if (move_uploaded_file($file, $dest)) {
                $update_order = "Update `order` set userid = '$userid', color = '$color', size = '$size', qat = '$qat',
                                                    price = '$price', sum = '$sum', `status` = '$status',  `desc` = '$desc' ,
                                                    date = '$date', imgname = '" . $tmp_time . '.' . $exten . "', imgtype = '$imgtype',
                                                    imgpic = '$dest', original_name = '$imgname' where id = '$id'";
                mysqli_query($conn,$update_order);
                echo 'true';
            }
        }
        else{
            echo 'false';
        }
    }
    else{
        $update_order = "Update `order` set userid = '$userid', color = '$color', size = '$size', qat = '$qat', price = '$price', sum = '$sum', `status` = '$status',  `desc` = '$desc' , date = '$date' where id = '$id'";
        if(mysqli_query($conn,$update_order)){
            echo 'true';
        }
        else{
            echo 'false';
        }
    }
    
    
?>