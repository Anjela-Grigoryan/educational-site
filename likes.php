<?php
include_once 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM `like` WHERE `id` = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$resultCheck = mysqli_num_rows($result);

if($resultCheck == 0){
    $sql2 = "INSERT INTO `like`(`id`, `like`) VALUES ('$id', '1')";
    $result2 = mysqli_query($conn, $sql2);
    header("Location:wellcome.php");

}else{
    $sql2 = "DELETE FROM `like` WHERE `id` = $id";
    $result2 = mysqli_query($conn, $sql2);
    header("Location:wellcome.php");
}

?>