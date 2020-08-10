<?php
    header('content-type: application/json');
    include 'init.php';
    $bodys = json_decode(file_get_contents('php://input'));
    $id = $bodys->Id;
    $delete_record = "delete from member where id = '$id'";
    mysqli_query($conn,$delete_record);
?>