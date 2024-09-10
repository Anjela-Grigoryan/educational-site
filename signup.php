<?php

include_once 'db.php';
$firstErr = $lastErr = $emailErr = $uidErr = $pwdErr = $genderErr = $apwdErr = "";
$first = $last = $email = $uid = $pwd = $gender = $apwd = "";


    $su = $_POST['uid'];
    $se = $_POST['email'];
    $s = "SELECT * FROM users WHERE `user_uid` = '$su'";
    $s_e = "SELECT * FROM users WHERE `user_email` = '$se'";

    $result = mysqli_query($conn, $s);
    $resultCheck = mysqli_num_rows($result);
    

    $result1 =  mysqli_query($conn, $s_e);
    $resultCheck1 = mysqli_num_rows($result1);
    
    

if (!empty($_POST['first'])) {
    $first = $_POST['first'];
} else {
    $firstErr = 'Please enter your name';
}

if (!empty($_POST['last'])) {
    $last = $_POST['last'];
} else {
    $lastErr = 'Please enter your lastname';
}

if (!empty($_POST['email'])) { 
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        if($resultCheck1 > 0){
            $emailErr = 'this email is already in use';
        }else{
            $email = $_POST['email']; 
        }
       
    }else{
        $emailErr = "write the correct email";
    };
    
} else {
    $emailErr = 'Please enter your email';
}

if (!empty($_POST['uid'])) {
    

    if($resultCheck > 0){
        $uidErr = 'this username is already in use';
    }else{
        $uid = $_POST['uid'];
    }
} else {
    $uidErr = 'Write username';
}

if (!empty($_POST['pwd'])) {
    $pwd = $_POST['pwd'];
    $pwd = password_hash($pwd, PASSWORD_DEFAULT);
} else {
    $pwdErr = 'write password';
}

if (!empty($_POST['apwd'])) {
    if($_POST['pwd'] == $_POST['apwd']){
        $apwd = $_POST['apwd'];
    }else{
        $pwdErr = $apwdErr = 'different passwords';
    }
    
} else {
    $apwdErr = 'write password';
}

if (!empty($_POST['gender'])) {
    $gender = $_POST['gender'];
} else {
    $genderErr = 'Please enter your gender';
}




if (!empty($first) && !empty($last) && !empty($email) && !empty($uid) && !empty($pwd) && !empty($gender) && !empty($apwd)) {
    $sql = "INSERT INTO `users`(`user_first`, `user_last`, `user_email`, `user_uid`, `user_pwd`, `user_gender`) 
                            VALUES ('$first','$last','$email','$uid','$pwd','$gender')";
    mysqli_query($conn, $sql);
    header("Location:register.php");
} else {
    header("Location:register.php?firstErr=$firstErr&lastErr=$lastErr&emailErr=$emailErr&uidErr=$uidErr&pwdErr=$pwdErr&gender=$genderErr&apwdErr=$apwdErr");
}


?>