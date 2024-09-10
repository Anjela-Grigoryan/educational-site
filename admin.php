<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="adminpageCss/style.css">
    <link rel="stylesheet" href="userStyle.css">
    <link rel="stylesheet" href="adminpageCss/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" 
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <div class="admincontainer">
        <div class="adminmenu">
        <div class="adminMenu">

        <?php
            include_once 'db.php';
            session_start();
            $msg = '';
            $targetDir = "./image/";
            $filename = basename($_FILES['file']['name']);
            $targetFilePath = $targetDir.$filename;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            $nameErr = $fvErr = $priceErr = $radiokgErr = $radiopcsErr = $fileErr = '';


            $adName = $_SESSION['adminName']; 
            $adsql = "SELECT * FROM `admin` WHERE `user_uid` = '$adName'";
            $adResult = mysqli_query($conn, $adsql);
            $adrow = mysqli_fetch_assoc($adResult);
            $adname = $adrow['user_first'];

            if($adrow['user_gender'] == 'female'){
                ?>
                <div class="imgp">
                    <img class = "imgGender" src="./img/6.jpg" alt="female">
                    <?="<p>$adname</p>"?>
                </div>
                <?php
            }elseif($adrow['user_gender'] == 'mail'){
                ?>
                <div class="imgp">
                    <img class = "imgGender" src="./img/7.jpg" alt="mail">
                    <?="<p>$adname</p>"?>
                </div>
                <?php 
            }elseif($adrow['user_gender'] == 'other'){
                ?>
                <div class="imgp">
                    <img class = "imgGender" src="./img/8.jpg" alt="other">
                    <?="<p>$adname</p>"?>
                </div>
                <?php
                
            }

            ?>
        <div class="lgbtn">
            <div class="btnbtn"><a href="./index.php">user page</a></div>
            <div class="btnbtn"><a href="./adminLogin.php">log out</a></div>
        </div>
        
        </div>
        </div>
        <!-- <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="file" accept=".png, .jpg, .jpeg, .pgf, .gif, .webp, .jfif" value="select a picture">
            <input type="button" value="submit">
        </form> -->
        <div class="adpagecontainer">
            
            <form class="upload" action="upload.php" method="post" enctype="multipart/form-data">
                <input name="name" type="text" placeholder="product name">
                <p style="color:red"><?=$_GET['nameErr']?></p>
                <input style="display: none;" id="inptKG" name = "price" type="text" placeholder="kg price">
                <input style="display: none;" id="inptPCS" name = "pcsprice" type="text" placeholder="pcs price">
                <p style="color:red"><?=$_GET['priceErr']?></p>
                <div name = "radiokgpcs" class="radio">
                    <p>kg</p><input id="kg" name="r" type="radio">
                    <p>pcs</p><input id="pcs" name="r" type="radio">
                </div>
                <p style="color:red"><?=$_GET['radiopcsErr']?></p>
                <div class="radio">
                    <p>vegetable</p><input name="vf" type="radio">
                    <p>fruit</p><input name="fv" type="radio">
                </div>
                <p style="color:red"><?=$_GET['fvErr']?></p>
                <div name = "radiosale" class="radio radiosale"><p>sale</p><input name="rSale" class="rSale" type="radio"></div>
                <input name = "inputsale" class="saleInput" type="text">
                <input type="file" name="file" accept=".png, .jpg, .jpeg, .pgf, .gif, .webp, .jfif">
                <p style="color:red"><?=$_GET['fileErr']?></p>
                <input type="submit" name="submit" class="submit" value="Upload">
            </form>

            <?php
                $sql = "SELECT * FROM `adminpage`";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
                ?>
                <div class="allProducts">
                <?php
                if($resultCheck > 0){
                    while($row = mysqli_fetch_assoc($result)){
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
                                <p><?=$row['name']?></p>
                                <?php
                                if(!empty($row['kgprice']) && empty($row['pcsprice'])){
                                    ?>
                                    <p>kg:<?=$row['kgprice']?> դրամ</p>
                                    <?php
                                }elseif(!empty($row['pcsprice']) && empty($row['kgprice'])){
                                    ?>
                                    <p>piece:<?=$row['pcsprice']?> դրամ</p>
                                    <?php
                                }else{
                                    ?>
                                    <p>kg:<?=$row['kgprice']?> դրամ</p>
                                    <p>piece:<?=$row['pcsprice']?> դրամ</p>
                                    <?php
                                }
                                ?>
                                <div class="icons">
                                    <?php $id = $row['id'];?>
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#exampleModal<?=$id?>">
                                        delete
                                    </button>
                                    <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#exampleModalCenter<?=$id?>">
                                        change
                                    </button>
                                </div>
                                
                            </div>

                                <!-- ---------------------------------------- -->
                                <div class="modal fade" id="exampleModal<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                          Do you really want to delete this product?
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">No</button>
                                            <a href="./adminDelete.php?id=<?=$id?>"><button type="button" class="btn btn-outline-warning">Yes</button></a>
                                          </div>
                                        </div>
                                    </div>
                                </div>

                        <!-- -----------------2modal----------------- -->
                        <div class="modal fade" id="exampleModalCenter<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                        <?php
                                        ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="ModalRows"><p>name</p>
                                                <a href="./adminPageChange.php?id=<?=$id?>&&name=name"><button class="btn btn-outline-info">change</button></a>
                                            </div>
                                            <div class="ModalRows"><p>price</p>
                                                <a href="./adminPageChange.php?id=<?=$id?>&&name=price"><button class="btn btn-outline-info">change</button></a>
                                            </div>
                                            <div class="ModalRows"><p>image</p>
                                                <a href="./adminPageChange.php?id=<?=$id?>&&name=img"><button class="btn btn-outline-info">change</button></a>
                                            </div>
                                            <div class="ModalRows"><p>sale</p>
                                                <a href="./adminPageChange.php?id=<?=$id?>&&name=sale"><button class="btn btn-outline-info">change</button></a>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                        </div>
                                      </div>
                                    </div>
                                <!-- ---------------------------------------- -->
                        <?php
                    }
                }
            ?>
    
        </div>
    </div>
    
    <script src="js/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="js/index.js"></script> -->
     <script src="./js/admin.js"></script>
</body>
</html>