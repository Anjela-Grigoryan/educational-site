<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="userStyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body class="adChangeContainerBody">
<?php
session_start();
$targetDir = "./images/";
$fileName = basename($_FILES["fileChange"]["name"]);   
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $_SESSION['id'] = $_GET['id'];
    if($_GET['name'] == 'name'){
        ?>
    <div class="adChangeContainer">
        <form class="for_product_changes" action="./adminChangeProcess.php" method="GET">
            <div class="inpdiv">
               <input type="text" name="name" placeholder="new name">
                <button class="btn btn-outline-info">change</button> 
            </div>
            <p style="color:red"><?=@$_GET['nameErr']?></p>
        </form>  
    </div>
    <?php
    }elseif($_GET['name'] == 'price'){
        ?>
    <div class="adChangeContainer">
        <form class="for_product_changes" action="./adminChangeProcess.php" method="GET">
            <div class="inpdiv">
                <input type="text" name="pcs_price" placeholder="new pcs price">
                <input type="text" name="kg_price" placeholder="new kg price">
                <button class="btn btn-outline-info">change</button>
            </div>
            <p style="color:red"><?=@$_GET['priceErr']?></p>
        </form>  
    </div>
    <?php
    }elseif($_GET['name'] == 'img'){
        ?>
        <div class="adChangeContainer">
            <form class="for_product_changes" action="./adminChangeProcess.php" method="post" enctype="multipart/form-data">
                <input type="file" name="file" accept=".png, .jpg, .jpeg, .pgf, .gif, .webp, .jfif">
                <p style="color:red"><?=$_GET['fileImgErr']?></p>
                <button name="submit" class="btn btn-outline-info">change</button>
            </form>
        </div>
        <?php
    }elseif($_GET['name'] == 'sale'){
        ?>
        <div class="adChangeContainer">
            <form class="for_product_changes" action="./adminChangeProcess.php" method="GET">
                <div class="inpsalediv">
                    <div style="display: flex;" name = "radiosale" class="rradiosale radio radiosale">
                        <p>sale</p><input name="rSale" class="rSale" type="radio">
                    </div>
                    <input name = "inputsale" class="saleInput" type="text"> 
                </div>
                <p style="color:red"><?=$_GET['saleErr']?></p>
                <button class="btn btn-outline-info">change</button>
            </form>
        </div>
        <?php
    } 

};
?>
<script src="./js/index.js"></script>
<script src="./js/admin.js"></script>
</body>
</html>




