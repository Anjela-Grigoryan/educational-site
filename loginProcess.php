<?php
require_once 'db.php';
session_start();

if (isset($_POST['Login'])) {
    $UName    = $_POST['UName'];
    $password = $_POST['Password'];
    if (!empty($UName) || !empty($password)) {
        $query  = "SELECT * FROM users WHERE user_uid = '$UName'";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 1) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $row['user_pwd'])) {
                    $_SESSION['User'] = $row['user_uid'];
                    header("location:wellcome.php");
                } else {
                    header("location:login.php?Invalid= User Name or Password is invalid");
                }
            }
        } else {
            header("location:login.php?Invalid= No user found on this User Name and Password");
        }
    } else {
        header("location:login.php?Invalid= User Name and Password is required");
    }
}
?>