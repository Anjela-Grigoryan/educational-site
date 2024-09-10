<?php
include "db.php";
session_start();
$msg = '';
$targetDir = "./image/";
$filename = basename($_FILES['file']['name']);
$targetFilePath = $targetDir.$filename;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);


$nameErr = $fvErr = $priceErr = $radiokgErr = $radiopcsErr = $fileErr = '';


    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        if(!empty($_POST['name'])  && (!empty($_POST['price']) || !empty($_POST['pcsprice'])) && (
            !empty($_POST['rkg'] || !empty($_POST['rpcs']))) && !empty($_FILES['file']['name'])){
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
            if (in_array($fileType, $allowTypes)) {
                if(ctype_alpha($_POST['name'])){
                    if((is_numeric($_POST['price']) && empty($_POST['pcsprice'])) || 
                    (is_numeric($_POST['pcsprice']) && empty($_POST['price'])) ||
                    (is_numeric($_POST['price']) && is_numeric($_POST['pcsprice']))){
                           if(move_uploaded_file($_FILES["file"]["tmp_name"],$targetFilePath)){
                                $n = $_POST['name'];
                                $kgp = $_POST['price'];
                                $s = $_POST['inputsale'];
                                $pcsp = $_POST['pcsprice'];
                                $vf = $_POST['vf'];
                                $fv = $_POST['fv'];
                                if(!empty($_POST['vf']) && empty($_POST['fv'])){
                                    $sqlOS ="INSERT INTO `adminpage`(`name`, `kgprice`, `file`, `discount`, `pcsprice`, `vegetables`, `fruits`) 
                                                    VALUES ('$n', '$kgp', '$filename', '$s', '$pcsp', 'vegetable', '')";
                                    $sqlResult = mysqli_query($conn, $sqlOS);
                                    header("Location:admin.php");
                                }elseif(!empty($_POST['fv']) && empty($_POST['vf'])){
                                    $sqlOS ="INSERT INTO `adminpage`(`name`, `kgprice`, `file`, `discount`, `pcsprice`, `vegetables`, `fruits`) 
                                    VALUES ('$n', '$kgp', '$filename', '$s', '$pcsp', '', 'fruit')";
                                    $sqlResult = mysqli_query($conn, $sqlOS);
                                    header("Location:admin.php"); 
                                }else if(!empty($_POST['fv']) && !empty($_POST['vf'])){
                                    $fvErr = 'choose one of';
                                    header("Location:admin.php?fvErr=$fvErr");
                                }else {
                                    $fvErr = 'choose one of';
                                    header("Location:admin.php?fvErr=$fvErr");
                                };
                                
                            }else{
                                $fileErr = "Sorry, there was an error uploading your file.";
                                header("Location:admin.php?fileErr=$fileErr");
                            }
                    }else{
                        $priceErr = 'only number';
                        header("Location:admin.php?priceErr=$priceErr");
                    }
                }else{
                    $nameErr = 'only letters';
                    header("Location:admin.php?nameErr=$nameErr");
                }    
            }else{
                $fileErr = "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.";
                header("Location:admin.php?fileErr=$fileErr");
            }
        }else{
            $fileErr = "choose File";
            $nameErr = $fvErr = $priceErr = $radiokgErr = $radiopcsErr = 'It is mandatory to fill in';
            header("Location:admin.php?nameErr=$nameErr&&fvErr=$fvErr&&priceErr=$priceErr&&radiokgErr=$radiokgErr&&radiopcsErr=$radiopcsErr&&fileErr=$fileErr");
        } 
    }

    // if(!empty('name') && !empty('price') && !empty('fv') && !empty('radiokg')){
            // if(!empty($_FILES['file']['name'])){
            //     $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');

            //     if (in_array($fileType, $allowTypes)) {
            //         //Upload file to server
            //         if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {  ////////////
            //         //Insert image file name into database
            //             $insert = "INSERT INTO adminpage (`file`)
            //                         VALUES ('$filename');";
            //             mysqli_query($conn, $insert);

            //             if ($insert) {
            //                 echo 'success';
            //             } else {
            //                 echo 'error';
            //             }
            //         }else{
            //             $statusMsg = "Sorry, there was an error uploading your file.";
            //         }
            
            //     }else{
            //         $msg = "Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.";
            //     }
            // }
    // }else{
    //     $msg = "fill in all fields";
    //     header("Location:admin.php?msg=$msg");
    // }     
    // }else{
    //     $msg = 'Please select a file to upload.';
    // }

?>