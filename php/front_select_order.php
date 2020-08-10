<?php
    include 'init.php';
    $uid = $_GET['uid'];
    $select_order = "Select * from `order` where userid = '$uid'";
    $obj = mysqli_query($conn, $select_order);
    // 如果帳號和密碼正確的話，寫入Session變數，並視情況重導到相關的頁面
    while($row = mysqli_fetch_array($obj)){
        $data_array[] = array(
            "id" => $row['id'],
            "status" => $row['status'],
            "image" => $row['imgpic'],
            "color" => $row['color'],
            "size" => $row['size'],
            "amount" => $row['qat'],
            "price" => $row['price'],
            "totalprice" => $row['sum'],
        );
    }
    echo json_encode($data_array,JSON_UNESCAPED_UNICODE);
?>