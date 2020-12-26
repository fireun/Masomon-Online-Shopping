<?php

include("../../config.php");
session_start();

date_default_timezone_set("Asia/Kuala_Lumpur");
// echo date('d-m-Y H:i:s'); //Returns IST
$date =  date("Y-m-d h:i:s");// current year-month-days hours:minut:seconts

//CREATE PRODUCT
if(isset($_POST['createProduct'])){
    $create_product_id = uniqid();
    $create_Invetory_id = uniqid();
    $create_Image_id = uniqid();

    $create_product_name = mysqli_real_escape_string($conn,$_POST['productName']);
    $create_product_price = mysqli_real_escape_string($conn,$_POST['productPrice']);
    $create_product_category = mysqli_real_escape_string($conn,$_POST['productCategory']);
    $create_product_color = mysqli_real_escape_string($conn,$_POST['productColor']);
    $create_product_gender = mysqli_real_escape_string($conn,$_POST['productGender']);
    $create_product_stock = mysqli_real_escape_string($conn,$_POST['productStock']);
    $create_product_brand = mysqli_real_escape_string($conn,$_POST['productBrand']);
    $create_product_material = mysqli_real_escape_string($conn,$_POST['productMaterial']);
    $create_product_description = mysqli_real_escape_string($conn,$_POST['productDescription']);
    $create_product_coverImage_baseName = basename($_FILES["coverImage"]["name"]);
    $create_product_coverImage = mysqli_real_escape_string($conn,basename($_FILES["coverImage"]["name"]));
       
    //Get the result of total stock 10%.
    $create_spaceInventory = $create_product_stock * 0.1;   
    $create_stock = $create_product_stock - $create_spaceInventory; 

    //product -> inventory -> variation -> productmedia
    if($_SESSION['sellerId']){
        $sellerId = $_SESSION['sellerId'];
        $insertnewProduct = "INSERT INTO `product`(`id`, `name`, `price`, `description`, `coverImage`, `color`, `brand`, `material`, `gender`, `soldRecord`, `sellerId`, `InventoryId`, `categoryId`, `auctionStatus`, `auctionId`, `auctionDueDate`, `date`, `imagesId`, `status`, `auctionEnd`, `created_time`, `uploadTime`) VALUES ('$create_product_id','$create_product_name','$create_product_price','$create_product_description','$create_product_coverImage','$create_product_color','$create_product_brand','$create_product_material','$create_product_gender', '', '$sellerId', '$create_Invetory_id', '$create_product_category', 'no', '', '', '', '$create_Image_id', '', '', '$date', '$date')";
        $resultInsertNewProduct = $conn->query($insertnewProduct);

        //create Success
        if($resultInsertNewProduct == true){
            $target_dir = '../../images/productImage/'; //images floder name destination
            $target = $target_dir.$create_product_coverImage_baseName;//get destination + original image name
            //insert inventory 
            $insertNewInventory = "INSERT INTO `inventory`(`inventoryId`, `productId`, `sellerId`, `totalStock`, `stock`, `spaceInventory`, `recordDate`) VALUES ('$create_Invetory_id', '$create_product_id', '$sellerId', '$create_product_stock', '$create_stock', '$create_spaceInventory', '$date')";
            $resultInsertNewInventory = $conn->query($insertNewInventory);

            if($resultInsertNewInventory == true){
                move_uploaded_file($_FILES["coverImage"]["tmp_name"],$target);//cover image
                
                //insert Variation
                if(empty($_POST['valueOfSize'])){ //No item checked
                    $_SESSION['m'] = "created-product-variaiton-empty-notic-01";
                    $_SESSION['m_last_action'] = time();
                    echo "<script>window.history.back()</script>";
                }else{
                    foreach($_POST['valueOfSize'] as $insertId){
                        $create_variation_id = uniqid();

                        $insertVariation= "INSERT INTO variation (variationId,productId,variation)VALUES('$create_variation_id','$create_product_id','$insertId')";
                        //run sql
                        $resultInsertVariation=$conn->query($insertVariation);
                    }
                }

                //check if insert media
                if(!empty($_FILES['input44']['name'][0])){

                    foreach($_FILES['input44']['name'] as $key=>$insertFile){
                        $create_product_media_id = uniqid("Media-");
                        $filetype = " ";
                    
                        $target_dir = '../../images/productImage/'; //images floder name destination
                        $target = $target_dir.$insertFile;//get destination + original image name
                        $images_extensions_arr = array("jpg","jpeg","png","gif","JPG","JPEG","PNG","GIF");
                        $video_extensions_arr = array("mp4","mp3","avi","3gp","mov","mpeg","wma","MP4","MP3","AVI","3GP","MOV","MPEG","WMA");
                    
                        $getFileType = pathinfo($_FILES['input44']['name'][$key],PATHINFO_EXTENSION); //get file type
                    
                        if( in_array($getFileType,$video_extensions_arr) ){
                            $filetype = "video";
                        }else if( in_array($getFileType,$images_extensions_arr) ){
                            $filetype = "image";
                        }else{
                            $_SESSION['m_last_action'] = time();
                            $_SESSION['m'] = "created-product-image-media-type-invalid-notic-01";
                            echo "<script>window.history.back();</script>";//wrong file type
                        }
                    
                        if(move_uploaded_file($_FILES['input44']['tmp_name'][$key], $target)){
                            // Insert record
                            $insertImage = "INSERT INTO `productmedia`(`mediaId`, `productId`, `filePath`, `fileType`, `update_time`) VALUES ('$create_product_media_id', '$create_product_id', '$insertFile', '$filetype', '$date')";
                            $resultInsertImage =$conn->query($insertImage);
                        }
                    }   
                } //end check empty media 
                
                $_SESSION['m'] = "created-product-successfully-notic-01";
                $_SESSION['m_last_action'] = time();
                header("location:../../business/viewAllProduct.php");

            }else{
                $_SESSION['m'] = "created-product-stock-failed-notic-01";
                $_SESSION['m_last_action'] = time();
                echo "<script>window.history.back()</script>";
            }

        }else{
            $_SESSION['m'] = "created-product-failed-notic-01";
            $_SESSION['m_last_action'] = time();
            echo "<script>window.history.back()</script>";
        }
    }else{
        $_SESSION['m'] = "created-product-failed-unlogin-loginFirst-notic-01";
        $_SESSION['m_last_action'] = time();
        echo "<script>window.history.back()</script>";
    }
}


//CREATE AUCTION PRODUCT
if(isset($_POST['createAuctionProduct'])){
    $create_auction_product_id = uniqid();
    $create_auction_Invetory_id = uniqid();
    $create_auction_Image_id = uniqid();
    $create_auction_id = uniqid();

    $create_auction_product_name = mysqli_real_escape_string($conn,$_POST['auctionProductName']);
    $create_auction_product_price = mysqli_real_escape_string($conn,$_POST['auctionProductPrice']);
    $create_auction_product_category = mysqli_real_escape_string($conn,$_POST['auctionProductCategory']);
    $create_auction_product_color = mysqli_real_escape_string($conn,$_POST['auctionProductColor']);
    $create_auction_product_gender = mysqli_real_escape_string($conn,$_POST['auctionProductGender']);
    $create_auction_product_stock = mysqli_real_escape_string($conn,$_POST['auctionProductStock']);
    $create_auction_product_brand = mysqli_real_escape_string($conn,$_POST['auctionProductBrand']);
    $create_auction_product_material = mysqli_real_escape_string($conn,$_POST['auctionProductMaterial']);
    $create_auction_product_description = mysqli_real_escape_string($conn,$_POST['auctionProductDescription']);
    $create_auction_product_duedate = mysqli_real_escape_string($conn,$_POST['auctionProductDueDate']);
    $create_auction_product_coverImage_baseName = basename($_FILES["coverImage"]["name"]);
    $create_auction_product_coverImage = mysqli_real_escape_string($conn,basename($_FILES["coverImage"]["name"]));
    $create_auction_date = date('Y-m-d', strtotime($_POST['auctionProductDueDate']));


    //product -> variation -> productmedia
    if($_SESSION['sellerId']){
        $target_dir = '../../images/productImage/'; //images floder name destination
        $target = $target_dir.$create_auction_product_coverImage_baseName;//get destination + original image name

       $sellerId = $_SESSION['sellerId'];
       $insertnewAuctionProduct = "INSERT INTO `product`(`id`, `name`, `price`, `description`, `coverImage`, `color`, `brand`, `material`, `gender`, `soldRecord`, `sellerId`, `InventoryId`, `categoryId`, `auctionStatus`, `auctionId`, `auctionDueDate`, `date`, `imagesId`, `status`, `auctionEnd`, `created_time`, `uploadTime`) VALUES ('$create_auction_product_id','$create_auction_product_name','$create_auction_product_price','$create_auction_product_description','$create_auction_product_coverImage','$create_auction_product_color','$create_auction_product_brand','$create_auction_product_material','$create_auction_product_gender', '', '$sellerId', '$create_auction_Invetory_id', '$create_auction_product_category', 'yes', '$create_auction_id', '$create_auction_product_duedate', '$create_auction_date', '$create_auction_Image_id', '', '', '$date', '$date')";
       $resultInsertNewAuctionProduct = $conn->query($insertnewAuctionProduct);

       //create Success
       if($resultInsertNewAuctionProduct == true){
            move_uploaded_file($_FILES["coverImage"]["tmp_name"],$target);//cover image
            
            //insert Variation
            if(empty($_POST['valueOfSize'])){ //No item checked
                $_SESSION['m'] = "created-product-variaiton-empty-notic-01";
                $_SESSION['m_last_action'] = time();
                echo "<script>window.history.back()</script>";
                
            }else{
                foreach($_POST['valueOfSize'] as $insertId){
                    $create_auction_variation_id = uniqid();
            
                    $insertVariation= "INSERT INTO variation (variationId,productId,variation)VALUES('$create_auction_variation_id','$create_auction_product_id','$insertId')";
                    //run sql
                    $resultInsertVariation=$conn->query($insertVariation);
                }
            }
            
            //check if insert media
            if(!empty($_FILES['input44']['name'][0])){
            
                foreach($_FILES['input44']['name'] as $key=>$insertFile){
                    $create_auction_product_media_id = uniqid("Media-");
                    $filetype = " ";
                
                    $target_dir = '../../images/productImage/'; //images floder name destination
                    $target = $target_dir.$insertFile;//get destination + original image name
                    $images_extensions_arr = array("jpg","jpeg","png","gif","JPG","JPEG","PNG","GIF");
                    $video_extensions_arr = array("mp4","mp3","avi","3gp","mov","mpeg","wma","MP4","MP3","AVI","3GP","MOV","MPEG","WMA");
                
                    $getFileType = pathinfo($_FILES['input44']['name'][$key],PATHINFO_EXTENSION); //get file type
                
                    if( in_array($getFileType,$video_extensions_arr) ){
                        $filetype = "video";
                    }else if( in_array($getFileType,$images_extensions_arr) ){
                        $filetype = "image";
                    }else{
                        $_SESSION['m_last_action'] = time();
                        $_SESSION['m'] = "created-product-image-media-type-invalid-notic-01";
                        echo "<script>window.history.back();</script>";//wrong file type
                    }
                
                    if(move_uploaded_file($_FILES['input44']['tmp_name'][$key], $target)){
                        // Insert record
                        $insertImage = "INSERT INTO `productmedia`(`mediaId`, `productId`, `filePath`, `fileType`, `update_time`) VALUES ('$create_auction_product_media_id', '$create_auction_product_id', '$insertFile', '$filetype', '$date')";
                        $resultInsertImage =$conn->query($insertImage);
                    }
                }   
            } //end check empty media 
            
            $_SESSION['m'] = "created-product-successfully-notic-01";
            $_SESSION['m_last_action'] = time();
            header("location:../../business/viewAllAuctionProduct.php");
       }

    }else{
       $_SESSION['m'] = "created-auction-product-failed-unlogin-loginFirst-notic-01";
       $_SESSION['m_last_action'] = time();
       echo "<script>window.history.back()</script>";
    }
}



// ----------------------------------------------------------------------------------------------------------


//UPDATE PRODUCT
if(isset($_POST['updateProduct'])){
    $edit_Poduct_id = $_POST['editProductId'];
    $edit_product_name = mysqli_real_escape_string($conn,$_POST['productName']);
    $edit_product_price = mysqli_real_escape_string($conn,$_POST['productPrice']);
    $edit_product_category = mysqli_real_escape_string($conn,$_POST['productCategory']);
    $edit_product_color = mysqli_real_escape_string($conn,$_POST['productColor']);
    $edit_product_gender = mysqli_real_escape_string($conn,$_POST['productGender']);
    $edit_product_stock = mysqli_real_escape_string($conn,$_POST['productStock']);
    $edit_product_brand = mysqli_real_escape_string($conn,$_POST['productBrand']);
    $edit_product_material = mysqli_real_escape_string($conn,$_POST['productMaterial']);
    $edit_product_description = mysqli_real_escape_string($conn,$_POST['productDescription']);

    //Get the result of total stock 10%.
    $edit_spaceInventory = $edit_product_stock * 0.1;   
    $edit_stock = $edit_product_stock - $edit_spaceInventory; 


    $updateProductStatement = "UPDATE `product` SET `name`='$edit_product_name', `price`='$edit_product_price', `description`='$edit_product_description', `color`='$edit_product_color', `brand`='$edit_product_brand', `material`='$edit_product_material', `gender`='$edit_product_gender', `categoryId`='$edit_product_category', `uploadTime`='$date' WHERE id='$edit_Poduct_id'";
    $resultUpdateProductStatement = $conn->query($updateProductStatement);

    if($resultUpdateProductStatement == true){

        //update stock 
        $updateStock = "UPDATE `inventory` SET `totalStock`='$edit_product_stock', `stock`='$edit_stock', `spaceInventory`='$edit_spaceInventory', `recordDate`='$date' WHERE productId = '$edit_Poduct_id'";
        $resultUpdateStock = $conn->query($updateStock);

        if($resultUpdateStock == true){
            
            //update variation
            //insert Variation
            if(empty($_POST['editOfSize'])){ //No item checked

            }else{
                foreach($_POST['editOfSize'] as  $key=>$insertId){
                    $edit_variation_id = uniqid();
                    
                    if(!empty($_POST['editOfSize'][$key])){
                        $insertVariation= "INSERT INTO variation (variationId,productId,variation)VALUES('$edit_variation_id','$edit_Poduct_id','$insertId')";
                        $resultInsertVariation=$conn->query($insertVariation);
                    }
                }
            }


            //check if insert media
            if(!empty($_FILES['editNewImage']['name'][0])){

                foreach($_FILES['editNewImage']['name'] as $key=>$insertFile){
                    $edit_product_media_id = uniqid("Media-");
                    $filetype = " ";
                
                    $target_dir = '../../images/productImage/'; //images floder name destination
                    $target = $target_dir.$insertFile;//get destination + original image name
                    $images_extensions_arr = array("jpg","jpeg","png","gif","JPG","JPEG","PNG","GIF");
                    $video_extensions_arr = array("mp4","mp3","avi","3gp","mov","mpeg","wma","MP4","MP3","AVI","3GP","MOV","MPEG","WMA");
                
                    $getFileType = pathinfo($_FILES['editNewImage']['name'][$key],PATHINFO_EXTENSION); //get file type
                
                    if( in_array($getFileType,$video_extensions_arr) ){
                        $filetype = "video";
                    }else if( in_array($getFileType,$images_extensions_arr) ){
                        $filetype = "image";
                    }else{
                        $_SESSION['m_last_action'] = time();
                        $_SESSION['m'] = "created-product-image-media-type-invalid-notic-01";
                        header("location: ../../business/createProduct.php?edit-product-id=$edit_Poduct_id");
                    }
                
                    if(move_uploaded_file($_FILES['editNewImage']['tmp_name'][$key], $target)){
                        // Insert record
                        $insertImage = "INSERT INTO `productmedia`(`mediaId`, `productId`, `filePath`, `fileType`, `update_time`) VALUES ('$edit_product_media_id', '$edit_Poduct_id', '$insertFile', '$filetype', '$date')";
                        $resultInsertImage =$conn->query($insertImage);
                    }
                }   
            } //end check empty media 

            //success
            $_SESSION['m'] = "update-product-success-notic-01";
            $_SESSION['m_last_action'] = time();
            header("location: ../../business/createProduct.php?edit-product-id=$edit_Poduct_id");

        }else{
            $_SESSION['m'] = "update-product-failed-notic-01";
             $_SESSION['m_last_action'] = time();
        }
    
    }else{
        $_SESSION['m'] = "update-product-failed-notic-01";
         $_SESSION['m_last_action'] = time();
    }
  
    header("location: ../../business/createProduct.php?edit-product-id=$edit_Poduct_id");
}




//UPDATE AUCTION PRODUCT
if(isset($_POST['updateAuctionProduct'])){
    $update_auction_product_id = $_POST['editProductId'];
    $update_auction_product_name = mysqli_real_escape_string($conn,$_POST['auctionProductName']);
    // $update_auction_product_price = mysqli_real_escape_string($conn,$_POST['auctionProductPrice']);
    $update_auction_product_category = mysqli_real_escape_string($conn,$_POST['auctionProductCategory']);
    $update_auction_product_color = mysqli_real_escape_string($conn,$_POST['auctionProductColor']);
    $update_auction_product_gender = mysqli_real_escape_string($conn,$_POST['auctionProductGender']);
    // $update_auction_product_stock = mysqli_real_escape_string($conn,$_POST['auctionProductStock']);
    $update_auction_product_brand = mysqli_real_escape_string($conn,$_POST['auctionProductBrand']);
    $update_auction_product_material = mysqli_real_escape_string($conn,$_POST['auctionProductMaterial']);
    $update_auction_product_description = mysqli_real_escape_string($conn,$_POST['auctionProductDescription']);
    // $update_auction_product_duedate = mysqli_real_escape_string($conn,$_POST['auctionProductDueDate']);
    // $update_auction_product_coverImage_baseName = basename($_FILES["coverImage"]["name"]);
    // $update_auction_product_coverImage = mysqli_real_escape_string($conn,basename($_FILES["coverImage"]["name"]));
    // $update_auction_date = date('Y-m-d', strtotime($_POST['auctionProductDueDate']));

    $updateProductStatement = "UPDATE `product` SET `name`='$update_auction_product_name', `description`='$update_auction_product_description', `color`='$update_auction_product_color', `brand`='$update_auction_product_brand', `material`='$update_auction_product_material', `gender`='$update_auction_product_gender', `categoryId`='$update_auction_product_category', `uploadTime`='$date' WHERE id='$update_auction_product_id'";
    $resultUpdateProductStatement = $conn->query($updateProductStatement);

    if($resultUpdateProductStatement == true){

        //insert Variation //update variation
        if(empty($_POST['editOfSize'])){ //No item checked

        }else{
            foreach($_POST['editOfSize'] as  $key=>$insertId){
                $update_variation_id = uniqid();
                
                if(!empty($_POST['editOfSize'][$key])){
                    $insertVariation= "INSERT INTO variation (variationId,productId,variation)VALUES('$update_variation_id','$update_auction_product_id','$insertId')";
                    $resultInsertVariation=$conn->query($insertVariation);
                }
            }
        }

        //check if insert media
        if(!empty($_FILES['editNewImage']['name'][0])){

            foreach($_FILES['editNewImage']['name'] as $key=>$insertFile){
                $update_product_media_id = uniqid("Media-");
                $filetype = " ";
            
                $target_dir = '../../images/productImage/'; //images floder name destination
                $target = $target_dir.$insertFile;//get destination + original image name
                $images_extensions_arr = array("jpg","jpeg","png","gif","JPG","JPEG","PNG","GIF");
                $video_extensions_arr = array("mp4","mp3","avi","3gp","mov","mpeg","wma","MP4","MP3","AVI","3GP","MOV","MPEG","WMA");
            
                $getFileType = pathinfo($_FILES['editNewImage']['name'][$key],PATHINFO_EXTENSION); //get file type
            
                if( in_array($getFileType,$video_extensions_arr) ){
                    $filetype = "video";
                }else if( in_array($getFileType,$images_extensions_arr) ){
                    $filetype = "image";
                }else{
                    $_SESSION['m_last_action'] = time();
                    $_SESSION['m'] = "created-product-image-media-type-invalid-notic-01";
                    header("location: ../../business/createAuctionProduct.php?edit-auction-product-id=$update_auction_product_id");
                }
            
                if(move_uploaded_file($_FILES['editNewImage']['tmp_name'][$key], $target)){
                    // Insert record
                    $insertImage = "INSERT INTO `productmedia`(`mediaId`, `productId`, `filePath`, `fileType`, `update_time`) VALUES ('$update_product_media_id', '$update_auction_product_id', '$insertFile', '$filetype', '$date')";
                    $resultInsertImage =$conn->query($insertImage);
                }
            }   
        } //end check empty media 

        //success
        $_SESSION['m'] = "update-product-success-notic-01";
        $_SESSION['m_last_action'] = time();
        header("location: ../../business/createAuctionProduct.php?edit-auction-product-id=$update_auction_product_id");

    }else{
        $_SESSION['m'] = "update-product-failed-notic-01";
         $_SESSION['m_last_action'] = time();
    }
    
}