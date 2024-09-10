<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="gradient">
        <form action="./adminLoginProcess.php" method="post" class="alcontainer">
            <input class="loginInput" name="adminName" type="text">
            <p style="color: red;"><?=@$_GET['adminNameErr']?></p>
            <input class="loginInput" name="adminPwd" type="text">
            <p style="color: red;"><?=@$_GET['adminPwdErr']?></p>
            <input class="send" type="submit" value="send">
        </form>
    </div>
    
</body>
</html>