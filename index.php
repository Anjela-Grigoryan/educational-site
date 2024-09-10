<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="userStyle.css">
    <link rel="stylesheet" href="adminpageCss/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="adminmenu">
        <div class="adminMenu">
            <a href="index.php"><h1>Rediska</h1></a>
            <div class="reglogad">
            <form action="./register.php" method="get">
                <div class="btnbtn">
                    <button>Registration</button>    
                </div>
            </form>
            <form action="./logIn.php" method="get">
                <div class="btnbtn">
                    <button>Log in</button>    
                </div>
            </form>
            <form action="./adminLogin.php" method="get">
                <div class="btnbtn">
                    <button>admin</button>    
                </div>
            </form>
            </div>
        </div>
        
    </div> 
    <?php
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
                                        <input placeholder="0.0" class="count" name="count" data-counter type="text">
                                        <div class="inputsp">
                                            <div class="pcsdiv">
                                                <input data-action="gplus" class="pp inppm" name="pcs+" type="button" value="+">
                                                <p>pcs</p>
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
                                        <input class="count" name="count" data-counter type="text" placeholder="0.0">
                                        <input data-action="pplus" class="pp inpmp inppm" name="pcs+" type="button" value="+">
                                        <p>pcs</p>
                                    </div>

                                    <?php
                                }else{
                                    ?>
                                <div class="count2">
                                    <div class="inputsm">
                                        <input data-action="pminus" class="pm inpmpcs inppm" name="pcs-" type="button" value="-">
                                        <input data-action="kgminus" class=" inpmkg inppm" name="kg-" type="button" value="-">
                                    </div>
                                    <input class="count" name="count" data-counter type="text" placeholder="0.0">
                                    <div class="inputsp">
                                        <div class="pcsdiv">
                                            <input data-action="pplus" class="pp inppm" name="pcs+" type="button" value="+">
                                            <p>pcs</p>
                                        </div>
                                        <div class="kgdiv">
                                            <input data-action="kgplus" class="inppm" name="kg+" type="button" value="+">
                                            <p>kg</p>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <?php                                         
                                }
                                ?>
                                
                                <p data-result></p>
                            </div>
                           
                            <div class="icns">
                                <div>
                                    <i data-toggle="modal" data-target="#exampleModalCenter" class="heart fa-regular fa-heart fa-xl" style="color: #df0707;"></i>
                                </div>
                                <div class="bascket">
                                    <i data-toggle="modal" data-target="#exampleModalCenter" class="icon fa-solid fa-basket-shopping fa-xl"></i>
                                </div>
                            </div>
                    </div>                       
                </div>
            <?php
        }
    }
    ?>
<!-- ------------------modal 3------------------ -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modalBody">
                <a href="./logIn.php">
                    <button type="button" class="btn btn-primary">log in</button>
                </a>
                <h4>Or</h4>
                <a href="./register.php">
                    <button type="button" class="btn btn-primary">Registration</button>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- ------------------------------------------- -->
    </div>
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/index.js"></script>
</body> 
</html>