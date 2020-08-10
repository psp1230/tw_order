<?php
    include 'init.php';
    $select_order = "SELECT `order`.*, member.user,member.surname FROM member INNER JOIN `order` ON `order`.userid = member.id ";
    $obj = mysqli_query($conn,$select_order);
    while($row = mysqli_fetch_array($obj)){
        $data_array[] = array(
            "id" => $row['id'],
            "account" => $row['user'],
            "name" => $row['surname'],
            "img" => $row['imgpic'],
            "color" => $row['color'],
            "size" => $row['size'],
            "num" => $row['qat'],
            "price" => $row['price'],
            "totalprice" => $row['sum'],
            "status" => $row['status'],
            "date" => $row['date'],
            "note" => $row['desc']
        );
    }
    echo json_encode($data_array,JSON_UNESCAPED_UNICODE);
?>



