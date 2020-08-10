<?php
    include 'init.php';
    $select_order = "SELECT record.* FROM record";
    $obj = mysqli_query($conn, $select_order);
    // 如果帳號和密碼正確的話，寫入Session變數，並視情況重導到相關的頁面
    while($row = mysqli_fetch_array($obj)){
        $data_array[] = array(
            "id" => $row['id'],
            "account" => $row['user'],
            "name" => $row['surname'],
            "money" => $row['money'],
            "date" => $row['date'],
            "desc" => $row['desc'],
        );
    }
    echo json_encode($data_array,JSON_UNESCAPED_UNICODE);
?>