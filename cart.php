<?php
    require_once 'db.php';
    $userN = $_SESSION['User'];
    $csql = "SELECT * FROM `bascet` WHERE `user_name` = '$userN'";
    $cresult = mysqli_query($conn, $csql);
    $cresultChack = mysqli_num_rows($cresult);
    
    
    // echo $cresult;
    ?>
    <div id = "bascetContainer" class="bascetnone bascetContainer">
        <div class="bascetContainer2">
            <div class="bascetProduct">
                <?php
                if($cresultChack == 0){
                ?>
                    <img src="./img/images.png" alt="">
                 <?php 
                }else{
                    $allTotal;
                     while($row = mysqli_fetch_assoc($cresult)){
                        $imageUrl = './image/' . $row['img'];
                        ?>
                        <div class="pContainer">
                            <img src="<?=$imageUrl?>" alt="">
                            <div class="info">
                                <p>name: <?=$row['product_name']?></p>
                                <p>count: <?=$row['product_count']?> </p>
                                <p>total: <?=$row['total']?></p>
                            </div>
                        </div>
                        <?php
                        $allTotal+=$row['total'];
                     }
                }
                ?>
            </div>
            <div class="totalDiv">
                <select class="select">
                    <option class = "amd" value="AMD">AMD</option>
                    <option class = "rub" value="RUB">RUB</option>
                    <option class = "usd" value="USD">USD</option>
                </select>
                <p class="alltotal1" style="display: none;"><?=$allTotal?></p>
                <div><p class="alltotal"><?=$allTotal?></p><h6 class="h6">դրամ</h6></div>
            </div>
                
            <div class="footer">
                <input type="text" placeholder="your number">
                <button style="margin-top: 5px;" type="button" class="btn btn-primary btn-sm">order</button>
            </div>
        </div>
    </div>

