<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include_once 'db.php';
        session_start();
        $adminNameErr = $adminPwdErr = '';

        if(!empty($_POST['adminName'] && !empty($_POST['adminPwd']))){
            $aname = $_POST['adminName'];
            $password =$_POST['adminPwd'];
            $adminSql = "SELECT * FROM `admin` WHERE `user_uid` = '$aname'";
            $adminResult = mysqli_query($conn, $adminSql);
            $adminrow = mysqli_fetch_assoc($adminResult);
            $aresultcheck = mysqli_num_rows($adminResult);
            

            if($aresultcheck > 0){
                if(password_verify($password, $adminrow['user_pwd'])){
                    $_SESSION['adminName'] = $adminrow['user_uid'];
                    header("Location:admin.php");
                }else{
                    $adminNameErr = $adminPwdErr = 'this password or username is invalid';
                    header("Location:adminLogin.php?adminNameErr=$adminNameErr&&adminPwdErr=$adminPwdErr");
                }
                
            }else{
                $adminNameErr = $adminPwdErr = 'this username or password is invalid';
                header("Location:adminLogin.php?adminNameErr=$adminNameErr&&adminPwdErr=$adminPwdErr");
            }
        }else{
            $adminNameErr = $adminPwdErr = 'error';
            header("Location:adminLogin.php?adminNameErr=$adminNameErr&&adminPwdErr=$adminPwdErr");
        }
    ?>
</body>
</html>