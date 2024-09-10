<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="userStyle.css">
    <link rel="stylesheet" href="adminpageCss/css/all.min.css">
    <link rel="stylesheet" href="bascet.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="adminmenu">
        <div class="adminMenu">
            <?php
            require_once 'db.php';
            session_start();

            $user = $_SESSION['User'];
            $sql = "SELECT * FROM `users` WHERE `user_uid` = '$user'";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>
            <div class="userPageInfo">
                <?php
                if($row['user_gender']  == 'male'){
                    ?>
                    <img src="./img/7.jpg" alt="">
                    <?php
                }elseif($row['user_gender'] == 'female'){
                    ?>
                    <img src="./img/6.jpg" alt="">
                    <?php
                }else{
                    ?>
                    <img src="./img/8.jpg" alt="">
                    <?php
                }
                ?> 
                <p><?=$row['user_first']." ".$row['user_last']?></p> 
            </div>
            <div style="margin-right: 20px;" class="">
                <i style="margin-right: 10px;" id="iconBascet" class="icon fa-solid fa-basket-shopping fa-xl"></i>
                <a href="./logIn.php">Log out</a> 
            </div>
            
        </div>
    </div>
    <?php
    include_once 'cart.php';

    include 'db.php';
    $sql = "SELECT * FROM `adminpage`";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    ?>
    <div class="allProducts">
    <?php
    if($resultCheck > 0){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $imageUrl = './image/' . $row['file'];
            ?>
                <div class='product'>
                    <?php
                        if(!empty($row['discount'])){
                            ?>
                            <div class="sale">
                                <p>-<?=$row['discount']?>%</p>
                            </div>
                            <?php
                        }
                    ?>
                    <div class='pimgp'>
                        <img src="<?=$imageUrl?>" alt="">
                    </div>
                    
                    <div class="forInfo">
                    <p data-phpid style="display:none;"><?=$id?></p>
                    <p data-user style="display:none;"><?=$user?></p>
                    <p data-file style="display:none;"><?=$row['file']?></p>
                    
                        <p><?=$row['name']?></p>
                        <?php
                            if(!empty($row['kgprice']) && empty($row['pcsprice'])){
                                ?>
                                <div class="pricees">kg:<p data-kgprice><?=$row['kgprice']?></p>դրամ</div>
                                <?php
                            }elseif(!empty($row['pcsprice']) && empty($row['kgprice'])){
                                ?>
                                <div class="pricees">piece:<p data-pcsprice><?=$row['pcsprice']?></p>դրամ</div>
                                <?php
                            }else{
                                ?>
                                <div class="pricees">kg:<p data-kgprice><?=$row['kgprice']?></p>դրամ</div>
                                <div class="pricees">piece:<p data-pcsprice><?=$row['pcsprice']?></p>դրամ</div>
                                <?php
                            }
                        ?>
                            <div class="counts">
                                <?php
                                if(!empty($row['kgprice']) && empty($row['pcsprice'])){
                                    ?>
                                    <div class="count2">
                                    <div class="inputsm">
                                        <input data-action="gminus" class="pm inpmpcs inppm" name="pcs-" type="button" value="-">
                                        <input data-action="kgminus" class=" inpmkg inppm" name="kg-" type="button" value="-">
                                    </div>
                                        
                                        <input class="count" name="count" data-counter type="text">
                                    
                                    <div class="inputsp">
                                        <div class="pcsdiv">
                                            <input data-action="gplus" class="pp inppm" name="pcs+" type="button" value="+">
                                            <p>g</p>
                                        </div>
                                        <div class="kgdiv">
                                            <input data-action="kgplus" class="inppm" name="kg+" type="button" value="+">
                                            <p>kg</p>
                                        </div>
                                    </div>
                                </div>
                                    
                                    <?php
                                }elseif(empty($row['kgprice']) && !empty($row['pcsprice'])){
                                    ?>
                                    <div class="count2">
                                        <input data-action="pminus" class="pm inpmpcs inpmp inppm" name="pcs-" type="button" value="-">
                                        
                                        
                                            <input class="count" name="count" data-counter type="text">
                                        
                                        <input data-action="pplus" class="pp inpmp inppm" name="pcs+" type="button" value="+">
                                        <p>pcs</p>
                                    </div>

                                    <?php
                                }
                                ?>
                                
                                
                                <p data-result></p>
                                <div class="icns">
                                <?php
                                $likeSql = "SELECT * FROM `like` WHERE `id` = '$id'";
                                $likeResult = mysqli_query($conn, $likeSql);
                                $likeResultCheck = mysqli_num_rows($likeResult);
                                if($likeResultCheck > 0){
                                ?>
                                <a style="color:black" href="./likes.php?id=<?=$id?>">
                                    <i class="fa-solid fa-heart fa-xl" style="color: #f41101;"></i>
                                </a>
                                <?php
                                }else{
                                ?>
                                <a style="color:black" href="./likes.php?id=<?=$id?>">
                                    <i class="fa-regular fa-heart fa-xl" style="color: #df0707;"></i>
                                </a>
                                <?php
                                }
                                ?>
                                <a class="basceta" data-bascet style="color:black" href="">
                                    <i class="icon fa-solid fa-basket-shopping fa-xl"></i>
                                </a>       
                            </div>
                        </div>
                    </div>
                                           
                </div>
            <?php
        }
    }
    ?>
    </div>

    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/cart.js"></script>
</body> 
</html>