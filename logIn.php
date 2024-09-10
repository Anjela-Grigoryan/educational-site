<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="container">
<div class="row">
    <div class="loginDiv">
        <div class="card bg-dark">
            <div class="card-title bg-primary text-white mt-5">
            </div>
            
            <div class="card-body">
                <form class="form" action="loginProcess.php" method="post">
                    <input type="text" name="UName" placeholder="User Name" class="form-control mb-3">
                    <input type="password" name="Password" placeholder="Password" class="form-control">
                    <?php
                    if (@$_GET['Invalid'] == true) {
                    ?>
                        <div style="color:red" class='alert-light text-danger text-center py-3'><?= @$_GET['Invalid']; ?></div>
                    <?php
                    }
                    ?>
                    <button class="btn btn-success mt-3" name="Login">Login</button>
                </form>
                <form action="adminLogin.php" method="get" class="adminform">
                    <button class="adminButton btn btn-light">admin</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>