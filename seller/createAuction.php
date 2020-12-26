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
        $q = basename($_FILES["image"]["name"]);//original image name
        $target = $uploads_dir.$q;//get destination + original image name

        //generate number
        $genderateProductId = uniqid();
        $genderateImagesId = uniqid();
        $genderateInventoryId = uniqid();
        // $genderateVariationId = uniqid();
        $auctionId = uniqid();

        $productName =  mysqli_real_escape_string($conn,$_POST['productName']);
        $productPrice = $_POST['productPrice'];
        $categoryId = $_POST['category'];
        $color = $_POST['color'];
        $gender = $_POST['gender'];
        $auctionStatus = "yes";
        $auctionDueDate = $_POST['auctionDueDate'];//auction product due date
        // $newauctionDuedate = date('Y-m-d H:i:s', strtotime($auctionDueDate));//convert to this statement
        // $stock = $_POST['stock'];
        $date = date('Y-m-d', strtotime($_POST['auctionDueDate']));
        $brand =  mysqli_real_escape_string($conn,$_POST['brand']);
        $material =  mysqli_real_escape_string($conn,$_POST['material']);
        $description =  mysqli_real_escape_string($conn,$_POST['description']);
        // $size = $_POST['size'];

        // $img = ($_FILES['image']['name']);
        // $image1 = $_POST['image1'];
        // $image2 = $_POST['image2'];
        // $image3 = $_POST['image3'];
        // $image4 = $_POST['image4'];
        // $image5 = $_POST['image5'];

        // image control part
        $img1 = basename($_FILES["image1"]["name"]);
        $target1 = $uploads_dir.$img1;
        $img2 = basename($_FILES["image2"]["name"]);
        $target2 = $uploads_dir.$img2;
        $img3 = basename($_FILES["image3"]["name"]);
        $target3 = $uploads_dir.$img3;
        $img4 = basename($_FILES["image4"]["name"]);
        $target4 = $uploads_dir.$img4;
        $img5 = basename($_FILES["image5"]["name"]);
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
        $mystockNumber = $_POST['stock'];        


        //insert product detail
        $productsql="insert into product (id,name,price,description,coverImage,color,
                    brand,material,gender,soldRecord,sellerId,InventoryId,categoryId,
                    auctionStatus,auctionId,auctionDueDate,date,imagesId) values('$genderateProductId',
                    '$productName','$productPrice','$description','$q','$color',
                    '$brand','$material','$gender','','$sellerId','$genderateInventoryId','$categoryId',
                    '$auctionStatus','$auctionId','$auctionDueDate','$date','$genderateImagesId')";//get $createname save follow database colmun
    
        //insert product's stock 
        $inventorysql="insert into inventory (inventoryid,productId,sellerId,totalStock,stock,spaceInventory)
                       values('$genderateInventoryId','$genderateProductId','$sellerId','$mystockNumber','','')";
                    
        // insert product's images with other table
        $imagesql="insert into images (imagesId,productId,image1,image2,image3,image4,image5)
                   values('$genderateImagesId','$genderateProductId','$img1','$img2','$img3','$img4','$img5')";
    

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

            // if(empty($_POST['valueOfSize'])){ //No item checked
            //     echo'<script type=text/javascript>window.alert("No Fill Product Size")</script> ';
            // }else{
            //     foreach($_POST['valueOfSize'] as $insertId){
            //         $genderateVariationId = uniqid();

                    
            //         $variationsql= "insert into variation (variationId,productId,variation)
            //         values('$genderateVariationId','$genderateProductId','$insertId')";

            //         //run sql
            //         $variationresult=$conn->query($variationsql);
            //     }

            //     if($variationresult == true){
            //         echo'<script type=text/javascript>window.alert("ok")</script> ';
            //     }else{
            //         echo'<script type=text/javascript>window.alert("no")</script> ';
            //     }                
            // } 
        
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
            echo'<script type=text/javascript>window.alert("Create Failure !!!")</script> ';
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
                $goodsAuctionStatus = $row['auctionStatus'];
                $goodsAuctionId = $row['auctionId'];
                $goodsAuctionDueDate = $row['auctionDueDate'];
                $goodsImagesId = $row['imagesId'];
                // id
                $goodsInventoryId=$row['InventoryId'];  
                $goodstCategoryId = $row['categoryId'];
                // $goodsImageId = $row['imagesId'];

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
                
                // if($resultgetInventory&&$resultgetCategory->num_rows > 0){ //over 1 database(record) so run
                //     //variation table
                //     // while($row = $resultgetVariation->fetch_assoc()){
                //     //     $goodsSize = $row['variation'];
                //     // }
                //     //inventory table
                //     while($row = $resultgetInventory->fetch_assoc()){
                //         $goodsTotalStock = $row['totalStock'];
                //     }
                //     //category table
                //     while($row = $resultgetCategory->fetch_assoc()){
                //         $goodsCategoryId = $row['categoryId'];
                //         $goodsCategoryType = $row['categoryType'];
                //     }
                //     //image table
                    
                // }
            }
        }

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
    }
        
    if(isset($_POST['update'])){
        echo $goodsid=$_POST['productId'] , "\n";
        $uploads_dir = '../images/productImage/'; //images floder name destination
        $q = mysqli_real_escape_string($conn,basename($_FILES["image"]["name"]));//original image name
        $tq = basename($_FILES["image"]["name"]);
        $target = $uploads_dir.$tq;//get destination + original image name

        $goodsName =  mysql_real_escape_string($conn,$_POST['productName']);
        $goodsPrice = $_POST['productPrice'];
        $goodsCategoryId = $_POST['category'];
        $goodsColor = $_POST['color'];
        $goodsGender = $_POST['gender'];
        $goodsAuctionStatus = 'yes';
        $goodsAuctionId = $_POST['auctionId'];
        $goodsAuctionDueDate = $_POST['auctionDueDate'];//auction product due date
        // $gNAD = date('Y-m-d H:i:s', strtotime($auctionDueDate));//convert to this statement
        // $stock = $_POST['stock'];
        $goodsBrand =  mysqli_real_escape_string($conn,$_POST['brand']);
        $goodsMaterial =  mysqli_real_escape_string($conn,$_POST['material']);
        $goodsDescription =  mysqil_real_escape_string($conn,$_POST['description']);
        $goodsdate = date('Y-m-d', strtotime($_POST['auctionDueDate']));
        $goodsImageId = $_POST['imageId'];
        $goodsCategoryId = $_POST['catgoryId'];

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
           brand='$goodsBrand',material='$goodsMaterial',gender='$goodsGender',soldRecord='',sellerId='$sellerId',InventoryId='',categoryId='$goodsCategoryId',
           auctionStatus='$goodsAuctionStatus',auctionId='$goodsAuctionId',auctionDueDate='$goodsAuctionDueDate',date='$goodsdate',imagesId='$goodsImageId' where id='$goodsid'";
      
         $updateImageSql = "update images set image1='$img1',image2='$img2',image3='$img3',image4='$img4',image5='$img5' where productId='$goodsid'";

         $updateresult=$conn->query($updatesql);
         $updateImageresult=$conn->query($updateImageSql);


         if($updateresult == TRUE){
            move_uploaded_file($_FILES["image"]["tmp_name"],$target);//cover image
            move_uploaded_file($_FILES["image1"]["tmp_name"],$target1);//image1
            move_uploaded_file($_FILES["image2"]["tmp_name"],$target2);//cover image
            move_uploaded_file($_FILES["image3"]["tmp_name"],$target3);//image1
            move_uploaded_file($_FILES["image4"]["tmp_name"],$target4);//cover image
            move_uploaded_file($_FILES["image5"]["tmp_name"],$target5);//image1

            echo'<script type=text/javascript>window.alert("Update Succeffull !!!")</script> ';
            echo "<script>window.location.assign('../seller/viewAllAuction.php');</script>";//Reload this page or go to hyperlink page
         }else{
            echo'<script type=text/javascript>window.alert("Update Failure !!!");window.history.go(-1)</script> ';    
         }      
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create Auction Product</title>
    <!-- Load an icon library -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" type="text/css" href="../css/reset.css">
    <link rel="stylesheet" type="text/css" href="../css/sellerstyle.css" charset="utf-8">
    <link rel="stylesheet" type="text/css" href="../css/tablestyle.css">
    <link rel="stylesheet" type="text/css" href="../css/footer.css">
     <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</head>
<body style="overflow-x:hidden">
    <?php require 'header.php' ?>
    <div class="content">
        <aside class=""> 
                <div class="container" style="padding:20px;">
                    <form action="createAuction.php" method="post" enctype="multipart/form-data">

                        <!-- product info and first page -->
                        <div class="create-product-tab-box" >
                            <input type="hidden" name="productId" value="<?php if(isset($_GET['productId'])){echo $goodsId;}?>" required>
                            <div>
                                <?php if(isset($_GET['productId'])){
                                    echo "<h3 style=\"font-size:25px\">Edit Auction Product Detail</h3>";
                                }else{
                                    echo "<h3 style=\"font-size:25px\">Create Auction Product <b>/</b> Product Detail</h3>";
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
                                    <label for="fname">Starting Price<span style="color:blue">&nbsp;&nbsp;RM</span></label>
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
                                                <input type="hidden" name="catgoryId" value="<?php echo $goodsCategoryId ?>">                                               
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
                                    <option value="1">Women's Clothing</option>
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
                            <div class="row">
                                <div class="col-25">
                                    <label for="fname">Auction Product Due date</label>
                                </div>
                                <div class="col-75" style="padding-top: 8px;">
                                    <input type="hidden" name="auctionId" value="<?php echo $goodsAuctionId;?>">
                                    <input type="datetime-local" id="auctionDuetimecheck" name="auctionDueDate" onchange="checkDate()">
                                    <span style="color:red" id="errorword">*<?php if(isset($_GET['productId'])) { echo 'current Due Date: ',$goodsAuctionDueDate; } ?></span> 
                                    <!-- <input type="radio" id="autionProduct" name="auction" value="yes" value="<?php if(isset($_GET['productId'])){echo $goodsId;}?>" onclick="checkauctionProduct()" required>
                                    <label for="Yes">Yes</label>
                                    <input type="radio" id="noautionProduct" name="auction" value="no" onclick="noauctionProduct()" required>
                                    <label for="No">No</label><br>
                                    <div id="auctionSelect" style="display:none">
                                        <label for="duedate">Due Date :</label>
                                        <input type="datetime-local" id="auctionDuetimecheck" name="auctionDueDate" onchange="checkDate()"> 
                                        <span style="color:red" id="errorword">*</span> 
                                    </div>                                     -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-25">
                                    <label for="fname">Product Stock</label>
                                </div>
                                <div class="col-75">
                                    <input type="text" id="fname" name="stock" placeholder="" value="1" readonly/>
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
                                    <textarea id="subject" name="description" placeholder="Write something about product information.." style="height:200px" value="<?php if(isset($_GET['productId'])){echo $goodsDescription;}?>"></textarea>
                                </div>
                            </div>
                            <!-- <div class="row" style="display:inline-block;">
                                <button type="submit" class="submit-btn">Cancel</button>
                                <button type="submit" id="nextVariationPage" class="submit-btn" onclick="openNextPage();">Next<i class='fas fa-arrow-right' style="padding-left:12px;font-size:15px"></i></button>
                            </div> -->
                        </div><!--End first page-->

                        <!-- product second page :size -->
                        <!-- <div class="create-product-tab-box">
                            <h3>Product Variation</h3>
                            //view
                            <div class="row">
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
                            </div>
                           //add
                            <div class="row">
                                <div class="col-25">
                                    <label for="subject">Input variation</label>
                                </div>                           
                                <div class="col-75">
                                    <input type="text" name="size" id="sizevalue" placeholder="key in variation for product" style="width:25%">
                                    <input type="button" name="addSize" id="addSize" value="Add variation" style="height:43px" onclick="getChoice()">
                                </div>
                            </div>
                            //<div class="row">
                                //<button type="submit" class="submit-btn"><i class='fas fa-arrow-left' style="padding-left:12px;font-size:15px"></i>Back</button>
                                //<button type="submit" class="submit-btn">Cancel</button>
                                //<button type="submit" class="submit-btn">Next<i class='fas fa-arrow-right' style="padding-left:12px;font-size:15px"></i></button>
                            </div>
                        </div> End second page -->

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
                                        accept=".jpg, .jpeg, .png" >
                                    <?php
                                        if(isset($_GET['productId'])){
                                            echo "<img src=\"../images/productImage/$goodsCoverImage\" alt=\"\" style=\"width:20%;height:20%;float:left;\">";
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
                                        accept=".jpg, .jpeg, .png" > 
                                    <?php
                                        if(isset($_GET['productId'])){
                                            echo "<img src=\"../images/productImage/$goodsimage1\" alt=\"\" style=\"width:20%;height:20%;float:left;\">";
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
                                        accept=".jpg, .jpeg, .png" > 
                                    <?php
                                        if(isset($_GET['productId'])){
                                            echo "<img src=\"../images/productImage/$goodsimage2\" alt=\"\" style=\"width:20%;height:20%;float:left;\">";
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
                                        accept=".jpg, .jpeg, .png"  > 
                                    <?php
                                        if(isset($_GET['productId'])){
                                            echo "<img src=\"../images/productImage/$goodsimage3\" alt=\"\" style=\"width:20%;height:20%;float:left;\">";
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
                                        accept=".jpg, .jpeg, .png" > 
                                    <?php
                                        if(isset($_GET['productId'])){
                                            echo "<img src=\"../images/productImage/$goodsimage4\" alt=\"\" style=\"width:20%;height:20%;float:left;\">";
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
                                        accept=".jpg, .jpeg, .png" >
                                    <?php
                                        if(isset($_GET['productId'])){
                                            echo "<img src=\"../images/productImage/$goodsimage5\" alt=\"\" style=\"width:20%;height:20%;float:left;\">";
                                        } 
                                    ?>  
                                </div>
                            </div>
                            <div class="row">
                                <button type="button" class="submit-btn cancel-btn mobile-btn">Cancel</button>
                                <?php  //is need edit account change the tittle ,normally is Driver Register 19B
                                    if(isset($_GET['productId'])){
                                        echo' <button type="submit" name="update" class="submit-btn mobile-btn"><i class="fa fa-save" style="padding-right:10px;font-size:20px"></i>Update Product</button>';
                                    }else{
                                        echo '<button type="submit" name="create" class="submit-btn mobile-btn"><i class="fa fa-save" style="padding-right:10px;font-size:20px"></i>Create Product</button>';
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
<script>
    //  var str1 = "<li><button style='font-size:20px'>";
    //  var strId = document.getElementById("sizevalue").value;//get value
    // //  var value = strId.innerHTML();
    //  var str2 = "<i class='fas fa-times hovertimes' title='remove'></i></button></li>";
  
    //  function getChoice(){
        
    //     var btn = document.createElement("input");//html tag
    //     btn.innerHTML = document.getElementById("sizevalue").value;//get value
    //     btn.id = 'sizeValue1';
    //     btn.className = 'siza-value1';
    //     btn.name = 'valueOfSize[]';
    //     // btn.value =[num];
    //     btn.style.float = 'left';
    //     btn.style.width = '50px';
    //     btn.style.margin = '0px 0px 0px 10px';
    //     btn.setAttribute("value", document.getElementById("sizevalue").value);//keep value in btn
    //     // btn.setAttribute("readonly", "true");//read only
    //     // var str1 ="<li>";
    //     var str2 = "<i class='<i class='fas fa-trash-alt' style='color:red'></i>' title='remove'></i>";
    //     // var met = str1+btn+str2;
    //     document.getElementById('displayValue').appendChild(btn);



    //     // var str1 = "<li><button style='font-size:20px'>";
    //     // var str2 = "<i class='fas fa-times hovertimes' title='remove'></i></button></li>";
    //     // var met = document.getElementById('displayValue').innerHTML(strId);
    //     // var strId = document.getElementById("sizevalue").value;//get value
    //     // // var met = str1+strId+str2;
    //     // // console.log(strId);
    //     // document.getElementById('displayValue').appendChild(met);
    //  }
//   $(document).ready(function(){
//     $("#addSize").click(function(){
//         // $("#displayValue").append(str1+strId+str2);
//         console.log(strId);
//     });
//   }); 
    
//   var isautionProduct = document.getElementById('#autionProduct').checked = true;
//   var noautionProduct = doument.getElementById('#noautionProduct');

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

</script>
</html>

