<?php
    include_once 'db.php';

    $id = $_GET['id'];
    $user = $_GET['username'];
    $count = $_GET['count'];
    $total = $_GET['total'];
    $img = $_GET['img'];


    $sql = "SELECT * FROM `adminpage` WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];

    $sql2 = "INSERT INTO `bascet`(`product_name`, `product_count`, `user_name`, `total`, `product_id`,`img`) 
                    VALUES ('$name','$count','$user','$total','$id','$img')";
    $result2 = mysqli_query($conn, $sql2);
    header("Location:wellcome.php");

?>