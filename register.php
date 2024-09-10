<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styleRegister.css">
</head>

<body>

    <div class="container">
        <form action="./signup.php" method="POST">
            <h1>Registration</h1>
            <input type="text" name="first" placeholder="firstname">
            <p style="color:red"><?=@$_GET['firstErr']?></p>
            <br>
            <input type="text" name="last" placeholder="lastname">
            <p style="color:red"><?=@$_GET['lastErr']?></p>
            <br>
            <input type="text" name="email" placeholder="E-mail">
            <p style="color:red"><?=@$_GET['emailErr']?></p>
            <br>
            <input type="text" name="uid" placeholder="username">
            <p style="color:red"><?=@$_GET['uidErr']?></p>
            <br>
            <input type="password" name="pwd" placeholder="password">
            <p style="color:red"><?=@$_GET['pwdErr']?></p>
            <br>
            <input type="password" name="apwd" placeholder="again password">
            <p style="color:red"><?=@$_GET['apwdErr']?></p>
            <br>
            <div class="gender">
            Gender:
            <input type="radio" name="gender" value="female">Female
            <input type="radio" name="gender" value="male">Male
            <input type="radio" name="gender" value="other">Other
            <br>
            </div>
            <p style="color:red"><?=@$_GET['genderErr']?></p>
            <button type="submit" name="submit"> Sign up</button>
        </form>  
    </div>
</body>