<?php
 
    include "../config.php";
    session_start();

    $sellerId = $_SESSION['sellerId'];//get seller id
    
    // if(isset($_POST['addSize'])){
    //     $checksize = array($_POST['namesize']);

    //     foreach ($checksize as $value) {
    //         echo'<script type=text/javascript>window.alert("';
    //         echo "$value";
    //         echo'")</script> ';
    //     }
    // }
    

    // Error Message
    $auctionDueDateErrorMessage = "";

    if(isset($_POST['create'])){
        $uploads_dir = '../images/productImage/'; //images floder name destination
        $q = mysqli_real_escape_string($conn,basename($_FILES["image"]["name"]));//original image name
        $tq = basename($_FILES["image"]["name"]);
        $target = $uploads_dir.$tq;//get destination + original image name

        //generate number
        $genderateProductId = uniqid();
        $genderateImagesId = uniqid();
        $genderateInventoryId = uniqid();
        // $genderateVariationId = uniqid();
        $auctionId = uniqid();

        $productName = mysqli_real_escape_string($conn,$_POST['productName']);
        $productPrice = mysqli_real_escape_string($conn,$_POST['productPrice']);
        $categoryId =  mysqli_real_escape_string($conn,$_POST['category']);
        $color = $_POST['color'];
        $gender = $_POST['gender'];
        $auctionStatus = "no";
        // $auctionDueDate = $_POST['auctionDueDate'];//auction product due date
        // $newauctionDuedate = date('Y-m-d H:i:s', strtotime($auctionDueDate));//convert to this statement
        // $stock = $_POST['stock'];
        $brand =  mysqli_real_escape_string($conn,$_POST['brand']);
        $material = $_POST['material'];
        $description =  mysqli_real_escape_string($conn,trim($_POST['description'])); 
        $SoldRecord = 0;
        // $size = $_POST['size'];

        // $img = ($_FILES['image']['name']);
        // $image1 = $_POST['image1'];
        // $image2 = $_POST['image2'];
        // $image3 = $_POST['image3'];
        // $image4 = $_POST['image4'];
        // $image5 = $_POST['image5'];

        // image control part
        $img1 = basename($_FILES["image1"]["name"]);
        $Dimg1 = mysqli_real_escape_string($conn,basename($_FILES["image1"]["name"]));
        $target1 = $uploads_dir.$img1;
        $img2 = basename($_FILES["image2"]["name"]);
        $Dimg2 = mysqli_real_escape_string($conn,basename($_FILES["image2"]["name"]));
        $target2 = $uploads_dir.$img2;
        $img3 = basename($_FILES["image3"]["name"]);
        $Dimg3 = mysqli_real_escape_string($conn,basename($_FILES["image3"]["name"]));
        $target3 = $uploads_dir.$img3;
        $img4 = basename($_FILES["image4"]["name"]);
        $Dimg4 = mysqli_real_escape_string($conn,basename($_FILES["image4"]["name"]));
        $target4 = $uploads_dir.$img4;
        $img5 = basename($_FILES["image5"]["name"]);
        $Dimg5 = mysqli_real_escape_string($conn,basename($_FILES["image5"]["name"]));
        $target5 = $uploads_dir.$img5;
        
        // CALCULATE FOR STOCK
        //My stock is 500.
        $mystockNumber = $_POST['stock'];        
        //I want to get 10% of 500.
        $percentToGet = 10;        
        //Convert our percentage value into a decimal.
        $percentInDecimal = $percentToGet / 100;        
        //Get the result.
        $spaceInventory = $percentInDecimal * $mystockNumber;        
        //Print it out - Result is 50.
        // echo $spaceInventory;
        //can use stock number
        $stock = $mystockNumber - $spaceInventory;

        //insert product detail
        $productsql="insert into product (id,name,price,description,coverImage,color,
                    brand,material,gender,soldRecord,sellerId,InventoryId,categoryId,
                    auctionStatus,auctionId,auctionDueDate,date,imagesId) values('$genderateProductId',
                    '$productName','$productPrice','$description','$q','$color',
                    '$brand','$material','$gender','$SoldRecord','$sellerId','$genderateInventoryId','$categoryId',
                    '$auctionStatus','','','','$genderateImagesId')";//get $createname save follow database colmun
    
        //insert product's stock 
       $inventorysql="insert into inventory (inventoryid,productId,sellerId,totalStock,stock,spaceInventory)
                       values('$genderateInventoryId','$genderateProductId','$sellerId','$mystockNumber','$stock','$spaceInventory')";
                    
        // insert product's images with other table
       $imagesql="insert into images (imagesId,productId,image1,image2,image3,image4,image5)
                   values('$genderateImagesId','$genderateProductId','$Dimg1','$Dimg2','$Dimg3','$Dimg4','$Dimg5')";
    

        // //insert size use for loop
        // $size = $_POST['valueOfSize'];
        // for ($index = 0; $index < count($size); $index++){
        
        //     // echo $size[$index], "\n";
        //     // // $currentSize = $size[$index];
        //     // // echo $currentSize, "\n";

        //     $sizeSQL = "insert into variation (variationId,productId,variation)
        //                values('$genderateVariationId','$genderateProductId','".$size[$index]."');";
            
        //     // $result3 = $conn->query($sizeSQL);             
        // } 

            if(empty($_POST['valueOfSize'])){ //No item checked
                echo'<script type=text/javascript>window.alert("No Fill Product Size")</script> ';
            }else{
                foreach($_POST['valueOfSize'] as $insertId){
                    $genderateVariationId = uniqid();

                    
                    $variationsql= "insert into variation (variationId,productId,variation)
                    values('$genderateVariationId','$genderateProductId','$insertId')";

                    //run sql
                    $variationresult=$conn->query($variationsql);
                }

                if($variationresult == true){
                    // echo'<script type=text/javascript>window.alert("ok")</script> ';
                }else{
                    echo'<script type=text/javascript>window.alert("insert variation failed")</script> ';
                }                
            } 
        
        // Run SQL 
        $result=$conn->query($productsql);
        $result1 = $conn->query($inventorysql);
        $result2 = $conn->query($imagesql);
        // $result3 = mysqli_multi_query($conn,$sizeSQL);

    
        //check sql status
        if($result && $result1 && $result2 == TRUE) {
            move_uploaded_file($_FILES["image"]["tmp_name"],$target);//cover image
            move_uploaded_file($_FILES["image1"]["tmp_name"],$target1);//image1
            move_uploaded_file($_FILES["image2"]["tmp_name"],$target2);//cover image
            move_uploaded_file($_FILES["image3"]["tmp_name"],$target3);//image1
            move_uploaded_file($_FILES["image4"]["tmp_name"],$target4);//cover image
            move_uploaded_file($_FILES["image5"]["tmp_name"],$target5);//image1
            echo'<script type=text/javascript>window.alert("Create Successfull !!!")</script> ';
        }else {
            echo'<script type=text/javascript>window.alert("Create Failure !!!");</script> ';
        }//end check sql status
    }

    // if(isset($_POST['addSize'])){
    //     $size = $_POST['size'];

    //     $getProductFirst = "Selcect id form product where ";

    //     $sizeSQL = "insert into variation (variationId,productId,variation)
    //     values('$genderateImagesId','','')";

    //     $result=$conn->query($productsql);
    // }


    //edit data
    if(isset($_GET['productId'])){
        $id=$_GET['productId'];
        $sql="select * from product where id='$id'";//id is database name
        $result=$conn->query($sql);
    
        if($result->num_rows > 0){ //over 1 database(record) so run
            while($row = $result->fetch_assoc()){
                //display result
                $goodsId=$row['id'];
                $goodsName = $row['name'];
                $goodsPrice=$row['price'];  
                $goodsDescription = $row['description'];
                $goodsCoverImage=$row['coverImage'];  
                $goodsColor = $row['color'];
                $goodsBrand=$row['brand'];  
                $goodsMaterial = $row['material'];
                $goodsGender=$row['gender'];  
                $goodsSoldRecord = $row['soldRecord'];
                $goodsCategoryId = $row['categoryId'];
                            
                // id
                $goodsInventoryId=$row['InventoryId'];
                $goodsImageId = $row['imagesId'];

                // $getVariation = "select * from variation where productId = '$goodsId'";
                $getImages = "select * from images where productId = '$goodsId'";
                $getInventory = "select * from inventory where productId ='$goodsId'";
                $getCategory = "select * from category where categoryId = '$goodsCategoryId'";

                // $resultgetVariation=$conn->query($getVariation);
                $resultgetImages=$conn->query($getImages);
                $resultgetInventory=$conn->query($getInventory);
                $resultgetCategory=$conn->query($getCategory);

                if($resultgetImages->num_rows>0){
                    while($row = $resultgetImages->fetch_assoc()){
                        $goodsimage1 = $row['image1'];
                        $goodsimage2 = $row['image2'];
                        $goodsimage3 = $row['image3'];
                        $goodsimage4 = $row['image4'];
                        $goodsimage5 = $row['image5'];
                    }
                }

                if($resultgetInventory->num_rows>0){
                    while($row = $resultgetInventory->fetch_assoc()){
                        $goodsTotalStock = $row['totalStock'];
                    }
                }

                // $_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];//return back
                // exit;
                // echo $previosLink = $_SERVER['PHP_SELF'] + '?productId=' +$goodsId;
                //check empty image
                $warningText = "No image";
                if(empty($goodsCoverImage)){
                    $goodsCoverImage = $warningText;
                }
                if(empty($goodsimage1)){
                    $goodsimage1 = $warningText;
                }
                if(empty($goodsimage2)){
                    $goodsimage2 = $warningText;
                }
                if(empty($goodsimage3)){
                    $goodsimage3 = $warningText;
                }
                if(empty($goodsimage4)){
                    $goodsimage4 = $warningText;
                }
                if(empty($goodsimage5)){
                    $goodsimage5 = $warningText;
                }
    
                // if($resultgetImages&&$resultgetInventory&&$resultgetCategory->num_rows > 0){ //over 1 database(record) so run
                //     //variation table
                //     // while($row = $resultgetVariation->fetch_assoc()){
                //     //     $goodsSize = $row['variation'];
                //     // }
                //     //category table
                //     while($row = $resultgetCategory->fetch_assoc()){
                //         $goodsCategoryId = $row['categoryId'];
                //         $goodsCategoryType = $row['categoryType'];
                //     }
                // }
            }

        }
    }
        
    if(isset($_POST['update'])){
        $goodsid=$_POST['productId'];
        $uploads_dir = '../images/productImage/'; //images floder name destination
        $q = mysqli_real_escape_string($conn,basename($_FILES["image"]["name"]));//original image name
        $tq = basename($_FILES["image"]["name"]);
        $target = $uploads_dir.$tq;//get destination + original image name

        $goodsName =  mysqli_real_escape_string($conn,$_POST['productName']);
        $goodsPrice = mysqli_real_escape_string($conn,$_POST['productPrice']);
        $goodsCategoryId = $_POST['category'];
        $goodsColor = $_POST['color'];
        $goodsGender = $_POST['gender'];
        $goodsAuctionStatus = 'no';
        // $goodsAuctionDueDate = $_POST['auctionDueDate'];//auction product due date
        // $goodsNewAuctionDuedate = date('Y-m-d H:i:s', strtotime($auctionDueDate));//convert to this statement
        // $stock = $_POST['stock'];
        $goodsBrand =  mysqli_real_escape_string($conn,$_POST['brand']);
        $goodsMaterial =  mysqli_real_escape_string($conn,$_POST['material']);
        $goodsDescription =  mysqli_real_escape_string($conn,trim($_POST['description']));
        $goodsImageId = $_POST['imageId'];
        $goodsCategoryId = $_POST['catgoryId'];
        $goodsInventoryId = $_POST['inventoryId'];

        // // image control part
        $img1 = basename($_FILES["image1"]["name"]);
        $Dimg1 = mysqli_real_escape_string($conn, basename($_FILES["image1"]["name"]));
        $target1 = $uploads_dir.$img1;

        $img2 = basename($_FILES["image2"]["name"]);
        $Dimg2 = mysqli_real_escape_string($conn, basename($_FILES["image2"]["name"]));
        $target2 = $uploads_dir.$img2;

        $img3 = basename($_FILES["image3"]["name"]);
        $Dimg3 = mysqli_real_escape_string($conn, basename($_FILES["image3"]["name"]));
        $target3 = $uploads_dir.$img3;

        $img4 = basename($_FILES["image4"]["name"]);
        $Dimg4 = mysqli_real_escape_string($conn, basename($_FILES["image4"]["name"]));
        $target4 = $uploads_dir.$img4;

        $img5 = basename($_FILES["image5"]["name"]);
        $Dimg5 = mysqli_real_escape_string($conn, basename($_FILES["image5"]["name"]));
        $target5 = $uploads_dir.$img5;
        
        // // CALCULATE FOR STOCK
        // //My stock is 500.
        // $mystockNumber = $_POST['stock'];        
        // //I want to get 10% of 500.
        // $percentToGet = 10;        
        // //Convert our percentage value into a decimal.
        // $percentInDecimal = $percentToGet / 100;        
        // //Get the result.
        // $spaceInventory = $percentInDecimal * $mystockNumber;        
        // //Print it out - Result is 50.
        // // echo $spaceInventory;
        // //can use stock number
        // $stock = $mystockNumber - $spaceInventory;
        
    $updatesql="update product set id='$goodsid',name='$goodsName',price='$goodsPrice',description='$goodsDescription',coverImage='$q',color='$goodsColor',
           brand='$goodsBrand',material='$goodsMaterial',gender='$goodsGender',soldRecord='0',sellerId='$sellerId',InventoryId='$goodsInventoryId',categoryId='$goodsCategoryId',
           auctionStatus='$goodsAuctionStatus',auctionId='',auctionDueDate='',imagesId='$goodsImageId' where id='$goodsid'";
      
    $updateImageSql = "update images set image1='$Dimg1',image2='$Dimg2',image3='$Dimg3',image4='$Dimg4',image5='$Dimg5' where productId = '$goodsid'";
        
        $updateresult=$conn->query($updatesql);
        $updatupdateImageSql=$conn->query($updateImageSql);

        if($updateresult && $updatupdateImageSql == true){
            move_uploaded_file($_FILES["image"]["tmp_name"],$target);//cover image
            move_uploaded_file($_FILES["image1"]["tmp_name"],$target1);//image1
            move_uploaded_file($_FILES["image2"]["tmp_name"],$target2);//cover image
            move_uploaded_file($_FILES["image3"]["tmp_name"],$target3);//image1
            move_uploaded_file($_FILES["image4"]["tmp_name"],$target4);//cover image
            move_uploaded_file($_FILES["image5"]["tmp_name"],$target5);//image1
            echo'<script type=text/javascript>window.alert("Update Succeffull !!!")</script> ';
            echo "<script>window.location.assign('./viewProduct.php');</script>";//Reload this page or go to hyperlink page
         }else{
            echo'<script type=text/javascript>window.alert("Update Failure !!!");window.history.go(-1);</script> ';
            // $site = "./viewProduct.php";
            // fopen($site,"r")
            // or exit("Unable to connect to $site");            
         } 
         
    }


// delete variation
if(isset($_POST['deleteVariation'])){
    if(empty($_REQUEST['EditvariationId'])){ //No item checked
        $deleteMessage= "You must checked delete product check box";
            echo "<script>window.alert('";
            echo $deleteMessage;
            echo "');";

    }else{
        foreach($_REQUEST['EditvariationId'] as $deleteId){
            $deleteMessage = $deleteId;
            //delete the item with the username
            $removerVariationSql="delete from variation where variationId='$deleteId'";

            $resultDelete=$conn->query($removerVariationSql);
            if($resultDelete == true){
                // $redirect_url = (isset($_SESSION['redirect_url'])) ? $_SESSION['redirect_url'] : '/';
                // unset($_SESSION['redirect_url']);
                // header("Location: $redirect_url", true, 303);
                // exit;
                // echo "<script>alert('remove success');
                //     window.location.href= '../seller/createProduct.php?";
                // echo $_GET['productId'];
                // echo ";</script>";   
                echo "<script>
                    alert('remove success'); 
                    window.history.go(-1);
                    </script>";
            }
        }
    }   
}//End delete variation   
    
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Product</title>
    <!-- Load an icon library -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/sellerstyle.css" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/tablestyle.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
    <link rel="stylesheet" type="text/css" href="../css/orderList.css">
     <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        @media screen and (max-width: 800px) {
            .create-product-tab-box {width:90%!important;}
            input[type=text],textarea,option,select {width: 100%!important;}
        }

        #addr0：hover {
            background: none!important;
        }

    .addrowBtn {
        width: 20%;
        color: black;
        background-color: #CD5C5C;
        border: none;
        color: white;
        padding: 10px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        border-radius: 5px;
        cursor:pointer;
    }

    .addrowBtn:hover {
        color:black;
    }
    </style>
</head>
<body style="overflow-x:hidden">
    <?php require 'header.php' ?>
    <div class="content">
        <aside class=""> 
                <div class="container" style="padding:20px;">
                    <form action="createProduct.php" method="post" enctype="multipart/form-data">

                        <!-- product info and first page -->
                        <div class="create-product-tab-box" >
                            <input type="hidden" name="productId" value="<?php if(isset($_GET['productId'])){echo $goodsId;}?>" required>
                            <div>
                                <?php if(isset($_GET['productId'])){
                                    echo "<h3 style=\"font-size:25px\">Edit Product <b>/</b> Product Detail</h3>";
                                }else{
                                    echo "<h3 style=\"font-size:25px\">Create Product <b>/</b> Product Detail</h3>";
                                }
                                ?>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="lname">Product Name</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="lname" name="productName" placeholder="Product Name" value="<?php if(isset($_GET['productId'])){echo $goodsName;}?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="fname">Product Price<span style="color:blue">&nbsp;&nbsp;RM</span></label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="fname" name="productPrice" placeholder="XX.XX" value="<?php if(isset($_GET['productId'])){echo $goodsPrice;}?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="category">Category</label>
                                    <?php
                                            if(isset($_GET['productId'])){ ?>
                                                <input type="hidden" name="catgoryId" value="<?php echo $goodsCategoryId; ?>">                                               
                                     <?php   }
                                        ?>
                                </div>
                                <div class="col-75">
                                    <select id="country" name="category" value="">
                                    <?php if(isset($_GET['productId'])){
                                        echo  "<option value=\"$goodsCategoryId\">$goodsCategoryType</option>";
                                    }
                                    ?>                                    
                                     <option value="9">Baby & Toys</option>
                                    <option value="6">Computer & Accessories</option>
                                    <option value="14">Fashion Accessories</option>
                                    <option value="7">Groceries & Pets</option>
                                    <option value="16">Games,Bookss & Hobbies</option>
                                    <option value="3">Health & Beauty</option>
                                    <option value="13">Home & Living</option>
                                    <option value="15">Home Appliances</option>
                                    <option value="0">Men's Clothing</option>
                                    <option value="5">Men's Bags & Wallets</option>
                                    <option value="12">Mes's Shoes</option>
                                    <option value="2">Mobile & Gadgets</option>
                                    <option value="18">Others</option>
                                    <option value="8">Sports & Outdoor</option>
                                    <option value="17">Women's Bags</option>                                    
                                    <option value="4">Women's Clothing</option>
                                    <option value="10">Women's Shoes</option>
                                    <option value="11">Watches</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="color">Color</label>
                                </div>
                                <div class="col-75">
                                    <select id="country" name="color" value="">
                                    <?php if(isset($_GET['productId'])){
                                        echo  "<option value=\"$goodsColor\">$goodsColor</option>";
                                    }
                                    ?>  
                                    <option value="Brown">Brown</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Black">Black</option>
                                    <option value="cyan">Cyan</option>
                                    <option value="DarkBlue">DarkBlue</option>
                                    <option value="gray">gray</option>
                                    <option value="green">green</option>
                                    <option value="LightBlue">LightBlue</option>
                                    <option value="orange">orange</option>
                                    <option value="Purple">Purple</option>
                                    <option value="red">red</option>
                                    <option value="yellow">yellow</option>
                                    <option value="white">White</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="category">Gender</label>
                                </div>
                                <div class="col-75">
                                    <select id="country" name="gender" value="">
                                    <?php if(isset($_GET['productId'])){
                                        echo  "<option value=\"$goodsGender\">$goodsGender</option>";
                                    }
                                    ?>  
                                    <option value="men">Men</option>
                                    <option value="female">Women</option>
                                    <option value="none">None</option>                    
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label for="fname">This is aution Product?</label>
                                </div>
                                <div class="col-75">
                                    <input type="radio" id="autionProduct" name="auction" value="yes" value="<?php if(isset($_GET['productId'])){echo $goodsId;}?>" onclick="checkauctionProduct()" required>
                                    <label for="Yes">Yes</label>
                                    <input type="radio" id="noautionProduct" name="auction" value="no" onclick="noauctionProduct()" required>
                                    <label for="No">No</label><br>
                                    <div id="auctionSelect" style="display:none">
                                        <label for="duedate">Due Date :</label>
                                        <input type="datetime-local" id="auctionDuetimecheck" name="auctionDueDate" onchange="checkDate()"> 
                                        <span style="color:red" id="errorword">*</span> 
                                    </div>
                                    
                                </div>
                            </div> -->
                            <div class="row">
                                <div class="col-25">
                                    <label for="fname">Product Stock</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="fname" name="stock" placeholder="" value="<?php if(isset($_GET['productId'])){echo $goodsTotalStock;}?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="fname">Brand</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="fname" name="brand" placeholder="" value="<?php if(isset($_GET['productId'])){echo $goodsBrand;}?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="fname">Product Material</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="fname" name="material" placeholder="" value="<?php if(isset($_GET['productId'])){echo $goodsMaterial;}?>">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="subject">Description</label>
                                </div>
                                <div class="col-75">
                                    <textarea id="subject" name="description" placeholder="Write something about product information.." style="height:200px" value="<?php if(isset($_GET['productId'])){echo $goodsDescription;}?>">
                                        <?php if(isset($_GET['productId'])){echo $goodsDescription;}?>
                                    </textarea>
                                </div>
                            </div>
                            <!-- <div class="row" style="display:inline-block;">
                                <button type="submit" class="submit-btn">Cancel</button>
                                <button type="submit" id="nextVariationPage" class="submit-btn" onclick="openNextPage();">Next<i class='fas fa-arrow-right' style="padding-left:12px;font-size:15px"></i></button>
                            </div> -->
                        </div><!--End first page-->

                        <!-- product second page :size -->
                        <div class="create-product-tab-box">
                            <h3>Product Variation</h3>
                            <!-- view -->
                            <!-- <div class="row">
                                <div class="col-25">
                                    <label for="subject">Variation</label>
                                </div>
                                <div class="col-75">
                                    <div id="displayValue">
                                        <?php
                                            if(isset($_GET['productId'])){
                                                echo "<input value=\"$goodsSize\" readonly></input>";
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div> -->
                            <!-- add -->
                            <div class="row">
                                <!-- <div class="col-25">
                                    <label for="subject">Input Variation</label>
                                </div>                           
                                <div class="col-75" id="addSize-cotent"> -->
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-sortable" id="tab_logic">
                                        <thead>
                                            <tr >
                                            <?php if(isset($_GET['productId'])){?>
                                                <input type="hidden" name="inventoryId" value="<?php echo $goodsInventoryId ?>">
                                                <th class="text-center">
                                                    No
                                                </th>
                                            <?php }
                                            ?>
                                                <th class="text-center">
                                                    Variation
                                                </th>
                                                <th class="text-center">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php
                                            if(isset($_GET['productId'])){
                                                $getVariation = "select * from variation where productId = '$goodsId'";
                                                $resultgetVariation=$conn->query($getVariation);
                                                if($resultgetVariation->num_rows > 0){ //over 1 database(record) so run
                                                    //variation table
                                                    // echo $row_number = mysqli_num_rows($resultgetVariation);
                                                    $countEachRow = 1;
                                                    while($row = $resultgetVariation->fetch_assoc()){
                                                        $variationId = $row['variationId'];
                                                        $goodsSize = $row['variation'];      
                                                        $countEachRow++;                                              
                                        ?>
                                            <tr id="<?php echo 'addr',$countEachRow?>" data-id="0" class="hidden">
                                                <td style="text-align:center;vertical-align:middle;">
                                                    <input type="checkbox" name="EditvariationId[]" value="<?php echo $variationId; ?>">
                                                </td>
                                                <td data-name="name">
                                                    <input type="text" name='EditvalueOfSize' placeholder='variation' class="form-control" value="<?php echo $goodsSize ?>"/>
                                                </td>
                                                <td data-name="del">
                                                    <button type="button"  class='btn btn-danger glyphicon glyphicon-remove row-remove submitBtn'><span aria-hidden="true">Remove Row</span></button>
                                                    <!-- <button name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove' style="width:60px"><span aria-hidden="true">×</span></button> -->
                                                </td>
                                            </tr>
                                        <?php
                                                }
                                            }
                                        }else { ?>
                                            <tr id="addr0" data-id="0" class="hidden">
                                                <td data-name="name">
                                                    <input type="text" name='valueOfSize[]' placeholder='variation' class="form-control"/>
                                                </td>
                                                <td data-name="del">
                                                    <button type="button"  name="del[]" class='btn btn-danger glyphicon glyphicon-remove row-remove submitBtn'><span aria-hidden="true">Remove Row</span></button>
                                                </td>
                                            </tr>
                                        <?php
                                             }
                                        ?>
                                        </tbody>
                                    </table> 
                                    <?php
                                    if(isset($_GET['productId'])){?>
                                        <button type="submit" name="deleteVariation" class="addrowBtn">Delete</button>
                                    <?php
                                    }   
                                    ?>
                                    <button type="button" id="add_row" class="addrowBtn">Add Row</button>
                                </div><!--End table reponsie-->
                           
                            </div><!--End row-->
                        <!-- <tab_logica id="add_row" class="btn btn-primary float-right">Add Row</a> -->
                  <!--  </div>End product Variation-->
                                    <!-- <div class="row createproduct-input" id='addr0' data-id="0">
                                        <input type="text" data-name="name" name="size" id="sizevalue" placeholder="key in variation for product" style="width:25%">
                                        <input type="button" data-name="del" id="remove_row" name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove submitBtn' value="Remove">
                                    </div>

                                    <div class="row createproduct-input2" id='addr1' data-id="0">
                                        <input type="text" data-name="name1" name="size" id="sizevalue" placeholder="key in variation for product" style="width:25%">
                                        <input type="button" data-name="del1" id="remove_row" name="del0" class='btn btn-danger glyphicon glyphicon-remove row-remove submitBtn' value="Remove">
                                    </div>

				                    <button type="button" id="add_sizerow" class="btn btn-primary float-right">Add row</button>
                                    <input type="button" name="addSize" id="addSize" value="Add variation" style="height:43px" onclick="getChoice()">
                                    <a href="javascript:hideTextBox()"></a> -->
                                <!-- </div>
                            </div> -->
                            <!-- <div class="row">
                                <button type="submit" class="submit-btn"><i class='fas fa-arrow-left' style="padding-left:12px;font-size:15px"></i>Back</button>
                                <button type="submit" class="submit-btn">Cancel</button>
                                <button type="submit" class="submit-btn">Next<i class='fas fa-arrow-right' style="padding-left:12px;font-size:15px"></i></button>
                            </div> -->
                        </div><!--End second page-->

                        <!-- product third page :image -->
                        <div class="create-product-tab-box">
                            <h3>Product Image</h3>
                            <?php
                                        if(isset($_GET['productId'])){ ?>
                                            <input type="hidden" name="imageId" value="<?php echo $goodsImagesId?>">
                             <?php       } 
                                    ?> 
                            <div class="row">
                                <div class="col-25">
                                    <label for="subject">Cover Image</label>
                                </div>
                                <div class="col-75">
                                    <input type="file" name="image" id="img-upload"
                                        accept=".jpg, .jpeg, .png">
                                    <?php
                                        if(isset($_GET['productId'])){
                                            echo "<img src=\"../images/productImage/$goodsCoverImage\" alt=\"\" style=\"width:20%;float:left;\">";
                                        } 
                                    ?> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="subject">Image 1</label>
                                </div>
                                <div class="col-75">
                                    <input type="file" name="image1" id="img-upload"
                                        accept=".jpg, .jpeg, .png"> 
                                    <?php
                                        if(isset($_GET['productId'])){
                                            echo "<img src=\"../images/productImage/$goodsimage1\" alt=\"\" style=\"width:20%;float:left;\">";
                                        } 
                                    ?> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="subject">Image 2</label>
                                </div>
                                <div class="col-75">
                                    <input type="file" name="image2" id="img-upload"
                                        accept=".jpg, .jpeg, .png"> 
                                    <?php
                                        if(isset($_GET['productId'])){
                                            echo "<img src=\"../images/productImage/$goodsimage2\" alt=\"\" style=\"width:20%;float:left;\">";
                                        } 
                                    ?> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="subject">Image 3</label>
                                </div>
                                <div class="col-75">
                                    <input type="file" name="image3" id="img-upload"
                                        accept=".jpg, .jpeg, .png" > 
                                    <?php
                                        if(isset($_GET['productId'])){
                                            echo "<img src=\"../images/productImage/$goodsimage3\" alt=\"\" style=\"width:20%;float:left;\">";
                                        } 
                                    ?> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="subject">Image 4</label>
                                </div>
                                <div class="col-75">
                                    <input type="file" name="image4" id="img-upload"
                                        accept=".jpg, .jpeg, .png"> 
                                    <?php
                                        if(isset($_GET['productId'])){
                                            echo "<img src=\"../images/productImage/$goodsimage4\" alt=\"\" style=\"width:20%;float:left;\">";
                                        } 
                                    ?> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="subject">Image 5</label>
                                </div>
                                <div class="col-75">
                                    <input type="file" name="image5" id="img-upload"
                                        accept=".jpg, .jpeg, .png">
                                    <?php
                                        if(isset($_GET['productId'])){
                                            echo "<img src=\"../images/productImage/$goodsimage5\" alt=\"\" style=\"width:20%;float:left;\">";
                                        } 
                                    ?>  
                                </div>
                            </div>
                            <div class="row">
                                <button type="button" class="submit-btn">Cancel</button>
                                <?php  //is need edit account change the tittle ,normally is Driver Register 19B
                                    if(isset($_GET['productId'])){
                                        echo' <button type="submit" name="update" class="submit-btn cancel-btn"><i class="fa fa-save" style="padding-right:10px;font-size:20px"></i>Update Product</button>';
                                    }else{
                                        echo '<button type="submit" name="create" class="submit-btn"><i class="fa fa-save" style="padding-right:10px;font-size:20px"></i>Create Product</button>';
                                    } 
                                ?>
                                <!-- <button type="submit" class="submit-btn"><i class='fas fa-arrow-left' style="padding-left:12px;font-size:15px"></i>Back</button> -->    
                                <!-- <button type="submit" name="create" class="submit-btn"><i class="fa fa-save" style="padding-right:10px;font-size:20px"></i>Create Product</button> -->
                            </div>
                        </div><!--End third page-->                    
                    </form>
                </div> <!--End container-->
        </aside>
    </div>
    <?php require 'footer.php' ?>
</body>
<script src="../js/sellerscript.js"></script>
<!-- <script src="../js/orderListscript.js"></script> -->

<script>
    //  var str1 = "<li><button style='font-size:20px'>";
    //  var strId = document.getElementById("sizevalue").value;//get value
    // //  var value = strId.innerHTML();
    //  var str2 = "<i class='fas fa-times hovertimes' title='remove'></i></button></li>";

    var ctr = 1;

// function getChoice() {
//     // is the table row I wanted to add the element before
//     var target = document.getElementById('displayValue');

//     var tblr = document.createElement('input');
//     // var tbld1 = document.createElement('input');
//     var tbld2 = document.createElement('a');



//     var tblin = document.createElement('input');
//     tblin.name = 'Size' + ctr;
//     tblin.id = 'size' + ctr;
//     tblin.placeholder = 'add another author';

//     // tbld1.appendChild(document.createTextNode('size' + ctr));

//     tbld2.appendChild(tblin);
//     tblr.appendChild(tbld1);
//     tblr.appendChild(tbld2);

//     target.parentNode.insertBefore(tblr, target);
//     ctr++;
// }

// function hideTextBox() {
//     var name = 'size' + (ctr - 1);
//     var pTarget = document.getElementById('displayValue');
//     var cTarget = document.getElementById(name);
//    var tr = cTarget.parentNode.parentNode;
//         tr.parentNode.removeChild(tr);
//         ctr = ctr - 1;
// }       

  
     function getChoice(){
        
        var btn = document.createElement("input");//html tag
        btn.innerHTML = document.getElementById("sizevalue").value;//get value
        btn.id = 'sizeValue';
        btn.className = 'siza-value1';
        btn.name = 'valueOfSize[]';
        // btn.value =[num];
        btn.style.float = 'left';
        btn.style.width = '50px';
        btn.style.margin = '0px 0px 0px 10px';
        // btn.placeholder = "<i class='fas fa-trash-alt' style='color:red' title='remove'></i>";
        btn.setAttribute("value", document.getElementById("sizevalue").value);//keep value in btn
        // btn.setAttribute("readonly", "true");//read only
        var str1 ="<li>";
        var str2 = "<i class='fas fa-trash-alt' style='color:red' title='remove'></i></li>";
        var met = str1+btn+str2;
        document.getElementById('displayValue').appendChild(btn);
        // document.getElementById('sizeValue').innerHTML += '<i class=\"fas fa-trash-alt\" style=\"color:red\" title=\"remove\" onclick=\"removeIcon()\"></i>';



        // var str1 = "<li><button style='font-size:20px'>";
        // var str2 = "<i class='fas fa-times hovertimes' title='remove'></i></button></li>";
        // var met = document.getElementById('displayValue').innerHTML(strId);
        // var strId = document.getElementById("sizevalue").value;//get value
        // // var met = str1+strId+str2;
        // // console.log(strId);
        // document.getElementById('displayValue').appendChild(met);
     }
//   $(document).ready(function(){
//     $("#addSize").click(function(){
//         // $("#displayValue").append(str1+strId+str2);
//         console.log(strId);
//     });
//   }); 
    
//   var isautionProduct = document.getElementById('#autionProduct').checked = true;
//   var noautionProduct = doument.getElementById('#noautionProduct');
// function removeIcon($id) {
//         document.getElementById('displayValue').removeChild(btn);

// }

function checkauctionProduct() {
    var a = document.getElementById('autionProduct').checked = true;
    document.getElementById('auctionSelect').style="display:block";
}

function noauctionProduct() {
    var b = document.getElementById('noautionProduct').checked = true;
    document.getElementById('auctionSelect').style="display:none";
    // document.getElementById('auctionDuetimecheck').setAttribute("value", "0000-00-00 00:00:00");
}


function checkDate(){
    var inputDate = document.getElementById("auctionDuetimecheck").value;//get due time
    // console.log(inputDate);

    //check value is empty
    if(inputDate != null){
        // console.log('no empty');
        var countDownDate = new Date(inputDate).getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

            // Get today's date and time
            var now = new Date().getTime();
                
            // Find the distance between now and the count down date
            var distance = countDownDate - now;
                
            // Time calculations for days, hours, minutes and seconds
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
            //auction due date is must current day more than 7 days
            if(days<7){ //less than 7 
                // console.log('falise');
                document.getElementById("errorword").innerHTML = "Due Date cann't less than 7 days, Please reselect again";
                clearTimeout(x);
            }else { //pass
                console.log('pass');
                document.getElementById("errorword").innerHTML = "";
                clearTimeout(x);
            }
        }, 1000);
    }else {
        // console.log('empty');
        document.getElementById("errorword").innerHTML = "Due Date cann't be empty / null";
    }
}

// variation part js
// function addsize(){
//     // var keyvalue1 = document.getElementById('sizevalue');
//     var keyvalue = document.getElementById('sizevalue').value;//input value
//     // var time  = parseInt(keyvalue);

//     var create = document.createElement("BUTTON").setAttribute("name", "size1");;
//     create.appendChild(keyvalue);
//     document.getElementById('displayValue').appendChild(create);


//     // var display = document.getElementById('displayValue');
//     // console.log('1',keyvalue1.lenght);
//     // console.log('2',keyvalue);
//     // for (var i=0; i <= time; i++){
//     //     // var text1 = "<button name=";
//     //     // var text2 = "[i]>";
//     //     // var text3 = keyvalue[i];
//     //     // var text4 = "<i class='fas fa-times hovertimes' title='remove'></i></button>";
//     //     // console.log(keyvalue[i]);
//     //     console.log([i],'a');
//     // }
// }

$(document).ready(function() {
    $("#add_row").on("click", function() {
        // Dynamic Rows Code
        
        // Get max row id and set new id
        var newid = 0;
        $.each($("#tab_logic tr"), function() {
            //data-id > 0
            if (parseInt($(this).data("id")) > newid) {
                newid = parseInt($(this).data("id"));
            }
        });
        newid++;
        
        //new tr's id
        var tr = $("<tr></tr>", {
            id: "addr"+newid,
            "data-id": newid
        });
        
        // loop through each td and create new elements with name of newid
        $.each($("#tab_logic tbody tr:nth(0) td"), function() {
            var td;
            var cur_td = $(this);//current td
            
            var children = cur_td.children();
            
            // add new td and element if it has a nane
            if ($(this).data("name") !== undefined) {
                td = $("<td></td>", {
                    "data-name": $(cur_td).data("name")
                });
                
                var c = $(cur_td).find($(children[0]).prop('tagName')).clone().val("");
                c.attr("valueOfSize[]"); //name1...
                c.appendTo($(td));
                td.appendTo($(tr));
            } else {
                td = $("<td></td>", {
                    'text': $('#tab_logic tr').length
                }).appendTo($(tr));
            }
        });
        
        // add delete button and td
        /*
        $("<td></td>").append(
            $("<button class='btn btn-danger glyphicon glyphicon-remove row-remove'></button>")
                .click(function() {
                    $(this).closest("tr").remove();
                })
        ).appendTo($(tr));
        */
        
        // add the new row
        $(tr).appendTo($('#tab_logic'));
        
        $(tr).find("td button.row-remove").on("click", function() {
             $(this).closest("tr").remove();
        });
    });




    // Sortable Code
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
    
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        
        return $helper;
    };
  
    $(".table-sortable tbody").sortable({
        helper: fixHelperModified      
    }).disableSelection();

    $(".table-sortable thead").disableSelection();

    $("#add_row").trigger("click");
});



</script>
</html>

