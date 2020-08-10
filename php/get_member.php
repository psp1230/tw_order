<?php
    include 'init.php';
    $select_member = "Select * from member";
    $obj = mysqli_query($conn,$select_member);
    while ($row = mysqli_fetch_array($obj)){
        $data_array[] = array(
            "id" => $row['id'],
            "account" => $row['user'],
            "email" => $row['email'],
            "phone" => $row['phone'],
            "name" => $row['surname'],
            "addr" => $row['addr'],
            "date" => $row['date']
        );
    }
    echo json_encode($data_array,JSON_UNESCAPED_UNICODE);
?>