<?php
include_once 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM `adminpage` WHERE `id` = '$id'";
$result = mysqli_query($conn, $sql);
header('Location:admin.php');

?>