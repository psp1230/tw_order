<?php
    include 'init.php';
    $create_table_member = "CREATE TABLE member(
        id int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user VARCHAR(12) NOT NULL,
        pwd VARCHAR(20) NOT NULL,
        email VARCHAR(30) NOT NULL,
        surname VARCHAR(5) NOT NULL,
        phone VARCHAR(10) NOT NULL,
        bouns int(10) NOT NULL,
        addr VARCHAR(50) NOT NULL,
        date VARCHAR(30) NOT NULL

    )";
    $create_table_record = "CREATE TABLE record(
        id int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userid int(8) NOT NULL,
        transaction VARCHAR(20) NOT NULL,
        remark VARCHAR(20) NOT NULL,
        date VARCHAR(30) NOT NULL
    )";
    $create_table_order = "CREATE TABLE `order`(
        id int(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        userid int(8) NOT NULL,
        color VARCHAR(10) NOT NULL,
        size VARCHAR(10) NOT NULL,
        qat int(8) NOT NULL,
        price int(8) NOT NULL,
        sum int(8) NOT NULL,
        status VARCHAR(8) NOT NULL,
        imgname VARCHAR(255) NOT NULL
    )";

    mysqli_query($conn, $create_table_member);
    mysqli_query($conn,$create_table_record);
    mysqli_query($conn,$create_table_order);
?>