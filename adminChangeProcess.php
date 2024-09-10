<?php
include_once 'db.php';
session_start();


$nameErr = $priceErr = $saleErr = $fileImgErr ='';

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $id = $_SESSION['id'];
        if(isset($_GET['name'])){
            
            if(!empty($_GET['name'])){
                $newName = $_GET['name'];
                $sql = "UPDATE `adminpage` SET `name`='$newName' WHERE `id` = '$id'";
                $result = mysqli_query($conn, $sql);
                header("Location:admin.php");
            }else{
                $nameErr = 'empty field';
                header("Location:adminPageChange.php?id=$id&&name=name&&nameErr=$nameErr");
            }
        }elseif(isset($_GET['pcs_price'])&& isset($_GET['kg_price'])){
            if(!empty($_GET['pcs_price']) && !empty($_GET['kg_price'])){
                if(is_numeric($_GET['pcs_price']) && is_numeric($_GET['kg_price'])){
                    $pprice = $_GET['pcs_price'];
                    $kgprice = $_GET['kg_price'];
                    $sql = "UPDATE `adminpage` SET `kgprice`='$kgprice', `pcsprice`='$pprice' WHERE `id` = '$id'";
                    $result = mysqli_query($conn, $sql);
                    header("Location:admin.php");
                }else{
                    $priceErr = 'only numbers';
                    echo $priceErr;
                    header("Location:adminPageChange.php?id=$id&&name=price&&priceErr=$priceErr");
                }
            }elseif(!empty($_GET['pcs_price']) && empty($_GET['kg_price'])){
                if(is_numeric($_GET['pcs_price'])){
                    $pprice = $_GET['pcs_price'];
                    $sql = "UPDATE `adminpage` SET `pcsprice`='$pprice',`kgprice`='' WHERE `id` = '$id'";
                    $result = mysqli_query($conn, $sql);
                    header("Location:admin.php");
                }else{
                    $priceErr = 'only numbers';
                    echo $priceErr;
                    header("Location:adminPageChange.php?id=$id&&name=price&&priceErr=$priceErr");
                };
            }elseif(empty($_GET['pcs_price']) && !empty($_GET['kg_price'])){
                if(is_numeric($_GET['kg_price'])){
                    $kgprice = $_GET['kg_price'];
                    $sql = "UPDATE `adminpage` SET `kgprice`='$kgprice',`pcsprice`='' WHERE `id` = '$id'";
                    $result = mysqli_query($conn, $sql);
                    header("Location:admin.php");
                }else{
                    $priceErr = 'only numbers';
                    echo $priceErr;
                    header("Location:adminPageChange.php?id=$id&&name=price&&priceErr=$priceErr");
                };
            }else{
                $priceErr = 'fill in at least one field';
                    echo $priceErr;
                    header("Location:adminPageChange.php?id=$id&&name=price&&priceErr=$priceErr");
            }
            
        }elseif(isset($_GET['inputsale'])){
            if(!empty($_GET['inputsale'])){
                if(is_numeric($_GET['inputsale'])){
                    $sale = ($_GET['inputsale']);
                    $sql = "UPDATE `adminpage` SET `discount`='$sale' WHERE `id` = '$id'";
                    $result = mysqli_query($conn, $sql);
                    header("Location:admin.php");
                }else{
                    $saleErr = 'only numbers';
                    header("Location:adminPageChange.php?id=$id&&name=sale&&saleErr=$saleErr");
                }
            }else{
                $sql = "UPDATE `adminpage` SET `discount`='' WHERE `id` = '$id'";
                $result = mysqli_query($conn, $sql);
                header("Location:admin.php");
            }
        };
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $targetDir = "./image/";
        $filename = basename($_FILES['file']['name']);
        $targetFilePath = $targetDir.$filename;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        $id = $_SESSION['id'];
        if(!empty($_FILES["file"]["name"])){
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($fileType, $allowTypes)){
                if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
                    $sql = "UPDATE `adminpage` SET `file`='$filename' WHERE `id` = '$id'";
                    $result = mysqli_query($conn, $sql);
                    header("Location:admin.php");
                }else{
                    $fileImgErr = 'Sorry, there was an error uploading your file.';
                    header("Location:adminPageChange.php?id=$id&&name=img&&fileImgErr=$fileImgErr");
                };  
            }else{
                $fileImgErr = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                header("Location:adminPageChange.php?id=$id&&name=img&&fileImgErr=$fileImgErr");
            };
        }else{
            $fileImgErr = 'Please select a file to upload';
            header("Location:adminPageChange.php?id=$id&&name=img&&fileImgErr=$fileImgErr");
        }
    }
?>